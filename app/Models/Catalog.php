<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name',
        'description',
        'cover',
        'user_id'
    ];

    // Get the items for the Catalog.
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // Get the user who created the Catalog.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
