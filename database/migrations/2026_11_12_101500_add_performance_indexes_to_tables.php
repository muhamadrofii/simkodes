<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan database indexing untuk efisiensi query pencarian & filter SQL.
     */
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->index('nama', 'idx_members_nama');
            $table->index('tanggal_masuk', 'idx_members_tanggal_masuk');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->index('nama_barang', 'idx_inventories_nama_barang');
        });

        Schema::table('incoming_letters', function (Blueprint $table) {
            $table->index('reference_number', 'idx_incoming_ref_number');
        });

        Schema::table('outgoing_letters', function (Blueprint $table) {
            $table->index('reference_number', 'idx_outgoing_ref_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropIndex('idx_members_nama');
            $table->dropIndex('idx_members_tanggal_masuk');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropIndex('idx_inventories_nama_barang');
        });

        Schema::table('incoming_letters', function (Blueprint $table) {
            $table->dropIndex('idx_incoming_ref_number');
        });

        Schema::table('outgoing_letters', function (Blueprint $table) {
            $table->dropIndex('idx_outgoing_ref_number');
        });
    }
};
