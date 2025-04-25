<h2>Daftar Mahasiswa</h2>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Kelas</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mahasiswas as $mhs)
            <tr>
                <td>{{ $mhs->id }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->kelas }}</td>
                <td>
                    @if ($mhs->foto)
                        <img src="{{ public_path('storage/' . $mhs->foto) }}" width="70">
                    @else
                        Tidak ada foto
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
