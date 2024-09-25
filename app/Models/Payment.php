<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'house_id',
        'user_id',
        'amount',
        'payment_method',
    ];
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function house()
    {
        return $this->belongsTo(House::class);
    }
    public function Transaction(){
        return $this->belongsTo(Transaction::class);
    }
}
