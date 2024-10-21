<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'rental_start_date',
        'rental_end_date',
        'total_price',
        'pick_location',
        'drop_location',
        'status',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // A rental is associated with one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
