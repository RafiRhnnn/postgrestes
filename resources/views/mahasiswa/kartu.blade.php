<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
            /* Warna teks jadi hitam */
        }

        .card-container {
            width: 100%;
            height: 100%;
            padding: 50px;
            box-sizing: border-box;
        }

        .card {
            border: 2px solid #000;
            border-radius: 10px;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            height: 300px;
            background-color: #fff;
            /* background putih agar teks hitam terlihat */
        }

        .info {
            width: 65%;
        }

        .info h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #000;
        }

        .info p {
            font-size: 18px;
            margin: 10px 0;
            color: #000;
        }

        .foto-container {
            width: 30%;
            text-align: center;
        }

        .foto {
            width: 120px;
            height: 150px;
            object-fit: cover;
            border: 2px solid #000;
            border-radius: 8px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="card-container">
        <div class="card">
            <div class="info">
                <h2>Kartu Mahasiswa</h2>
                <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
                <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
                <p><strong>Kelas:</strong> {{ $mahasiswa->kelas }}</p>
                <p><strong>Jurusan:</strong> {{ $mhs->jurusan }}</p>

            </div>
            <div class="foto-container">
                @if ($mahasiswa->foto)
                    <img src="{{ public_path('storage/' . $mahasiswa->foto) }}" class="foto" alt="Foto">
                @else
                    <p>Tidak ada foto</p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
