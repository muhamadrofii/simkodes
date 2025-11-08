<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Officer extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama',
        'image',
        'umur',
        'jenis_kelamin',
        'jabatan',
        'tempat_tinggal',
        'no_anggota_koperasi',
        'tanggal_diangkat',
        'tanggal_berhenti',
        'ttd',
        'keterangan',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
