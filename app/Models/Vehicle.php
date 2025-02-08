<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'plate_number',
        'status'
    ];

    public function setPlateNumber($value)
    {
        $this->attributes['plate_number'] = strtoupper($value);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function bookingHistories()
    {
        $this->hasMany(BookingHistories::class);
    }
}