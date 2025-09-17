<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('arsip_surat', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->unsignedBigInteger('kategori_id');
        $table->string('nomor_surat')->nullable();
        $table->date('tanggal_surat')->nullable();
        $table->string('file'); // untuk menyimpan path PDF
        $table->timestamps();

        $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
