<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'description',
    ];

    public function house(){
        return $this->belongsTo(House::class);
    }
    public function sales(){
        return $this->hasMany(sale::class);
    }
}
