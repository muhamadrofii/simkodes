<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',          // relasi ke tabel categories
        'nama',
        'umur',
        'jenis_kelamin',
        'mata_pencaharian',
        'tempat_tinggal',
        'tanggal_masuk',
        'cap_ibu_jari',
        'ttd',
        'image',
        'tanggal_keluar',
        'sebab_berhenti',
        'keterangan',
    ];

    /**
     * Relasi ke tabel Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
