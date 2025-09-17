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
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('judul');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('file'); // nama file PDF
            $table->timestamps();

            // Relasi ke tabel kategori
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategori')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
