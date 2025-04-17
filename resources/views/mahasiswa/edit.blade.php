<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Edit Mahasiswa</h1>

        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" value="{{ $mahasiswa->kelas }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>
