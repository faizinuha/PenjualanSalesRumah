<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
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
