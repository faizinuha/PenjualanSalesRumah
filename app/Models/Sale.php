<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'house_id', 'fasilitas_id', 'sale_date', 'total_price'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function Fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
