<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>UTB Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="bg-light">
    @include('layouts.header')

    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
