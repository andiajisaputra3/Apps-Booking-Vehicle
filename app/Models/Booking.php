<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'booking_name',
        'vehicle_id',
        'driver_id',
        'approval_status',
        'overall_approval_status',
        'current_approval_level',
        'requested_at',
        'booking_date',
        'created_by'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }

    public function bookingHistories()
    {
        $this->hasMany(BookingHistories::class);
    }
}