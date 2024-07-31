<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'catalog_id'
    ];

    // Give the Catalog that owns the Item.
    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
