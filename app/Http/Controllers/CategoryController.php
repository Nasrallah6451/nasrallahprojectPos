<?php

namespace App\Http\Controllers;

use App\Models\Category; // Wajib ada agar tidak error "Class Category not found"
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('category.category', [
            "title" => "Kategori",
            "data" => Category::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi sebaiknya diberi batasan tipe data
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
        ]);

        // 2. Simpan data
        Category::create($request->all());

        // 3. Redirect ke route yang sesuai di web.php
        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Ditambahkan.');
    }
}