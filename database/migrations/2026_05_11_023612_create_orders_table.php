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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            
            // Menggunakan foreignId agar lebih ringkas (otomatis bigInteger unsigned)
            // constrained() secara otomatis mendeteksi tabel 'orders' dan 'products'
            // cascadeOnUpdate() dan cascadeOnDelete() adalah shortcut yang lebih bersih
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->integer('qty');
            $table->decimal('price', 15, 2); // Disarankan menggunakan decimal untuk uang/harga (lebih akurat dari double)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cukup drop tabel saja. 
        // Secara otomatis index dan foreign key di dalamnya akan ikut terhapus.
        Schema::dropIfExists('order_details');
    }
};