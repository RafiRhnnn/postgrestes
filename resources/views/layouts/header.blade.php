<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow w-100">
    <div class="d-flex justify-content-between align-items-center w-100 px-4">
        <a class="navbar-brand fw-bold" href="#">Sistem Data Mahasiswa</a>
        <div class="d-flex align-items-center">
            <a class="nav-link text-white me-3" href="{{ route('mahasiswa.index') }}">Dashboard</a>
            <a class="nav-link text-white me-3" href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>
            <a class="nav-link text-white me-3" href="{{ route('mahasiswa.statistik') }}">Statistik</a>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
