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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->integer('price');
            $table->enum('status', ['sold', 'available'])->default('available'); // Status rumah: sold atau available
            $table->enum('tipe', ['apartement', 'house'])->default('house'); // Status rumah: sold atau available
            // $table->string('status')->default('available'); // Status rumah: available, sold, etc.
            $table->string('image'); // Kolom untuk menyimpan gambar rumah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
