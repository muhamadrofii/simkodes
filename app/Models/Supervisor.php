<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama',
        'image',
        'umur',
        'jenis_kelamin',
        'mata_pencaharian',
        'tempat_tinggal',
        'no_anggota_koperasi',
        'jabatan',
        'tanggal_dipilih',
        'tanggal_berhenti',
        'ttd_ketua',
        'keterangan',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
