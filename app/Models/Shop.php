<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_name',
     ];

    public function sales(){
        return $this->hasMany(Sale::class, 'shop');
    }

    public function getTotalAttribute()
    {
        return $this->sales()->sum('qty');
    }

}
