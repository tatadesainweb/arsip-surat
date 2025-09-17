<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ArsipController;

// Halaman utama diarahkan ke arsip
Route::get('/', [ArsipController::class, 'index'])->name('arsip.index');

// ==========================
// Route Surat
// ==========================
Route::prefix('surat')->name('surat.')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('index');
    Route::get('/create', [SuratController::class, 'create'])->name('create');
    Route::post('/store', [SuratController::class, 'store'])->name('store');
    Route::get('/{id}', [SuratController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SuratController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SuratController::class, 'update'])->name('update');
    Route::delete('/{id}', [SuratController::class, 'destroy'])->name('destroy');
});

// ==========================
// Route Arsip
// ==========================
Route::resource('arsip', ArsipController::class);
Route::get('/arsip/preview/{id}', [ArsipController::class, 'preview'])->name('arsip.preview');
Route::get('/arsip/download/{id}', [ArsipController::class, 'download'])->name('arsip.download');

// ==========================
// Halaman About
// ==========================
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/about', function () {
    return view('about', [
        'nama' => 'Nama : Neghita Arafa Yunia Arif',
        'nim' => '2331730038', 
        'foto' => 'images/fotoneghita.jpeg', // taruh file di public/images/
        'tanggal' => ' 04-09-2025', // tanggal pembuatan aplikasi
    ]);
})->name('about');
