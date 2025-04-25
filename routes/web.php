<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/mahasiswa'); // atau halaman utama kamu
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('/mahasiswa/export/excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.export.excel');
    Route::get('/mahasiswa/export/pdf', [MahasiswaController::class, 'exportPDF'])->name('mahasiswa.export.pdf');
});


require __DIR__ . '/auth.php';