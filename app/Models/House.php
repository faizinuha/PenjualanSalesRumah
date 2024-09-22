<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'price',
        'status',
        'image',
        'tipe'
    ];
    // protected $fillable = [
    //     ]
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function fasilitas(){
        return $this->hasMany(Fasilitas::class,);
    }
}
