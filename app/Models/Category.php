<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    /**
     * Get the members for the blog category.
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'category_id');
    }
    
    public function supervisors(): HasMany
    {
        return $this->hasMany(Supervisor::class, 'category_id');
    }
    
    public function officers(): HasMany
    {
        return $this->hasMany(Officer::class, 'category_id');
    }
}
