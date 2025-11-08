<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'tanggal',
        'jumlah',
        'harga_satuan',
        'jumlah_rupiah',
        'umur_teknis',
        'umur_ekonomis',
        'keterangan',
    ];
}
