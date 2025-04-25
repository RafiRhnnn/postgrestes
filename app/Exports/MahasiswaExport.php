<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromCollection
{
    public function collection()
    {
        return Mahasiswa::select('id', 'nama', 'nim', 'kelas')->get();
    }
}