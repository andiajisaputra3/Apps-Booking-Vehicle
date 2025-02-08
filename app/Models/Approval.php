<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'booking_id', 'user_id', 'approval_level', 'status', 'notes', 'approved_at', 'approval_role'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookingHistories()
    {
        $this->hasMany(BookingHistories::class);
    }
}