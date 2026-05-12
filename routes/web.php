<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
// Menambahkan import CustomerController sesuai instruksi gambar
use App\Http\Controllers\CustomerController; 

Route::get('/', function () {
    return view('dashboard', ["title" => "Dashboard"]);
});

// Route untuk Kategori
Route::resource('kategori', CategoryController::class);

// Route untuk Pelanggan (Customer) sesuai instruksi gambar
// Ini akan mencakup pelanggan.index, pelanggan.create, dll.
Route::resource('pelanggan', CustomerController::class)->except('destroy');