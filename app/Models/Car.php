<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['car_name', 'model', 'make_year', 'daily_rent', 'status', 'description', 'image', 'user_id'];
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }


}
