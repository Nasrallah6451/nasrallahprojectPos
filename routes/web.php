<?php

use Illuminate\Support\Facades\Route;
// 1. Pastikan nama Controller di sini sesuai dengan nama file aslinya di folder Controllers
use App\Http\Controllers\KategoriController; 

Route::get('/', function () {
    return view('dashboard', [
        "title" => "Dashboard"
    ]);
});

// 2. Cukup satu baris ini saja untuk menangani semua CRUD kategori
// Ini sudah mencakup kategori.index, kategori.store, kategori.edit, dll.
Route::resource('kategori',CategoryController::class)
->except('show','destroy','create');