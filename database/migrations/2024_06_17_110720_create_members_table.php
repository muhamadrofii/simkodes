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
        // Tabel anggota (members)
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('nama');
            $table->string('image')->nullable();
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('mata_pencaharian')->nullable();
            $table->string('tempat_tinggal')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('cap_ibu_jari')->nullable();
            $table->string('ttd')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('sebab_berhenti')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel pengurus (officers)
        Schema::create('officers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('nama');
            $table->string('image');
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('jabatan')->nullable();
            $table->string('tempat_tinggal')->nullable();
            $table->string('no_anggota_koperasi')->nullable();
            $table->date('tanggal_diangkat')->nullable();
            $table->date('tanggal_berhenti')->nullable();
            $table->string('ttd')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel pengawas (supervisors)
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('nama');
            $table->string('image');
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('mata_pencaharian')->nullable();
            $table->string('tempat_tinggal')->nullable();
            $table->string('no_anggota_koperasi')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tanggal_dipilih')->nullable();
            $table->date('tanggal_berhenti')->nullable();
            $table->string('ttd_ketua')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('officers');
        Schema::dropIfExists('supervisors');
    }
};
