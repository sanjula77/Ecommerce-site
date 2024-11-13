<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'category', 'image_path'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
