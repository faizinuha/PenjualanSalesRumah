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
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            // $table->string('name'); // Nama fasilitas (contoh: Kolam renang, Garasi, dll.)
            $table->foreignId('house_id')->constrained('houses')->onDelete('cascade'); // Foreign key ke tabel houses
            $table->text('description')->nullable(); // Deskripsi fasilitas, jika diperlukan
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
