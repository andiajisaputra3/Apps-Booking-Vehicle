<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistories extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'user_name',
        'vehicle_id',
        'vehicle_name',
        'driver_id',
        'driver_name',
        'booking_number',
        'booking_name',
        'approval_status',
        'overall_approval_status',
        'current_approval_level',
        'requested_at',
        'booking_date',
        'created_by',
        'notes',
        'changed_at',
    ];

    public function booking()
    {
        $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function approval()
    {
        $this->belongsTo(Approval::class);
    }
}