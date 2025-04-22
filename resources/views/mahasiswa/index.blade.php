<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Daftar Mahasiswa</h1>
        @if (Auth::user() && Auth::user()->isAdmin())
            <p>Halo Admin!</p>
        @else
            <p>Halo User biasa!</p>
        @endif

        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div>
            <form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-3 d-flex" style="gap: 10px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Mahasiswa..."
                    class="form-control w-25">

                <select name="sort_by" class="form-select w-25">
                    <option value="nama" {{ request('sort_by') == 'nama' ? 'selected' : '' }}>Sortir berdasarkan Nama
                    </option>
                    <option value="nim" {{ request('sort_by') == 'nim' ? 'selected' : '' }}>Sortir berdasarkan NIM
                    </option>
                    <option value="kelas" {{ request('sort_by') == 'kelas' ? 'selected' : '' }}>Sortir berdasarkan
                        Kelas</option>
                </select>

                <select name="sort_order" class="form-select w-25">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>A-Z</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Z-A</option>
                </select>

                <button type="submit" class="btn btn-primary">Terapkan</button>
            </form>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $mhs)
                    <tr>
                        <td>{{ $mhs->id }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->kelas }}</td>
                        <td>
                            @if ($mhs->foto)
                                <img src="{{ asset('storage/' . $mhs->foto) }}" alt="Foto" width="80">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus?')"
                                    class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data mahasiswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $mahasiswas->links() }}
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:underline btn btn-danger mb-3">Logout</button>
        </form>
    </div>

</body>

</html>
