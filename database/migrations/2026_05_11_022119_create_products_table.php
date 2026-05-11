<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('stock');
            $table->double('price');
            
            // Menggunakan foreignId agar lebih ringkas dan otomatis mereferensikan tabel categories
            $table->foreignId('category_id')
                  ->constrained('categories') 
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cukup dropIfExists, Laravel akan otomatis menghapus foreign key & index terkait
        Schema::dropIfExists('products');
    }
};