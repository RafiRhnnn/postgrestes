<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;



class MahasiswaController extends Controller
{

    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function exportPDF()
    {
        $mahasiswas = Mahasiswa::all();
        $pdf = PDF::loadView('mahasiswa.pdf', compact('mahasiswas'));
        return $pdf->download('mahasiswa.pdf');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::simplePaginate(8);
        $query = Mahasiswa::query();

        // Filter / Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nim', 'like', "%$search%")
                    ->orWhere('kelas', 'like', "%$search%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'nama'); // default 'nama'
        $sortOrder = $request->get('sort_order', 'asc'); // default ascending
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $mahasiswas = $query->paginate(5)->appends($request->all());

        return view('mahasiswa.index', compact('mahasiswas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim',
            'kelas' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'kelas' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);

        $data = $request->only(['nama', 'nim', 'kelas']);

        // Kalau ada foto baru diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }

            // Simpan foto baru
            $fotoBaru = $request->file('foto')->store('fotos', 'public');
            $data['foto'] = $fotoBaru;
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Hapus foto dari storage jika ada
        if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        // Hapus data dari database
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }




    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if ($user && $user->role !== 'admin' && !in_array($request->route()->getActionMethod(), ['index', 'show'])) {
                abort(403, 'Akses ditolak.');
            }
            return $next($request);
        });
    }
}