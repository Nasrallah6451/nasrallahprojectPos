<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    // Menampilkan semua data kategori
    public function index(): View
    {
        return view('category.category', [
            "title" => "Kategori",
            "data" => Category::all()
        ]);
    }

    // Menyimpan kategori baru
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
        ]);

        Category::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Ditambahkan.');
    }

    // Menampilkan halaman form edit
    public function edit(Category $kategori): View
    {
        return view('category.edit', compact('kategori'))->with(["title" => "Edit Kategori"]);
    }

    // Memperbarui data kategori ke database
    public function update(Request $request, Category $kategori): RedirectResponse
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string", // Mengikuti standar store (nullable)
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('updated', 'Kategori Berhasil Diubah.');
    }
}