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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->date('tanggal')->nullable();
            $table->string('jumlah')->nullable(); // bisa m/kg/kw
            $table->decimal('harga_satuan', 15, 2)->nullable();
            $table->decimal('jumlah_rupiah', 15, 2)->nullable();
            $table->string('umur_teknis')->nullable();
            $table->string('umur_ekonomis')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
