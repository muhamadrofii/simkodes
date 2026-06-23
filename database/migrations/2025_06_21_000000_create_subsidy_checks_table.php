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
        Schema::create('subsidy_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('subsidy_checks')->onDelete('cascade');
            $table->string('nik', 16)->nullable(); // NIK 16 digit, nullable
            $table->string('no_kk', 16)->nullable(); // KK 16 digit, nullable
            $table->string('nama'); // Nama penerima atau nama program subsidi
            $table->string('tahun', 4)->nullable(); // Tahun subsidi
            $table->string('periode')->nullable(); // Periode / Deskripsi periode subsidi
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsidy_checks');
    }
};
