@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Statistik Mahasiswa per Kelas</h1>
        <canvas id="kelasChart" height="100"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kelasChart').getContext('2d');
        const kelasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($statistik->keys()) !!},
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: {!! json_encode($statistik->values()) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
