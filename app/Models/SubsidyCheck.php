<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidyCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'nik',
        'no_kk',
        'nama',
        'tahun',
        'periode',
        'keterangan',
    ];

    /**
     * Dapatkan daftar klaim penerima untuk program subsidi ini.
     */
    public function claims()
    {
        return $this->hasMany(SubsidyCheck::class, 'parent_id');
    }

    /**
     * Dapatkan program subsidi asal dari klaim ini.
     */
    public function program()
    {
        return $this->belongsTo(SubsidyCheck::class, 'parent_id');
    }
}
