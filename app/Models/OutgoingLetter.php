<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'reference_number',
        'category',
        'received_date',
        'sender',
        'recipient',
        'summary',
        'file',
    ];
}
