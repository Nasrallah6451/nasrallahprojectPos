<?php

namespace App\Http\Controllers;

// Import sesuai instruksi gambar
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar customer.
     */
    public function index(): View
    {
        // Mengarah ke view 'customer.tabel' sesuai gambar
        return view('customer.tabel', [
            "title" => "Customer",
            "data" => Customer::all()
        ]);
    }

    /**
     * Menampilkan form tambah customer.
     */
    public function create(): View 
    {
        // Mengarah ke view 'customer.tambah' sesuai gambar
        return view('customer.tambah')->with(["title" => "Tambah Data Customer"]);
    }

    /**
     * Menyimpan data customer baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi wajib sesuai instruksi gambar
        $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "nullable"
        ]);

        // Menyimpan ke database
        Customer::create($request->all());

        // Redirect ke route 'pelanggan.index'
        return redirect()->route('pelanggan.index')->with('success', 'Data Customer Berhasil Ditambahkan');
    }

    // Method Edit, Update, dan Show tetap dipertahankan jika diperlukan
    public function edit(Customer $customer): View
    {
        return view('customer.edit', compact('customer'))->with(['title' => 'Edit Customer']);
    }

    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
        ]);

        $customer->update($request->all());
        return redirect()->route('pelanggan.index')->with('updated', 'Data Customer Berhasil Diubah');
    }

    public function show(Customer $customer): View
    {
        return view('customer.show', compact('customer'))->with(['title' => 'Detail Customer']);
    }
}