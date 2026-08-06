<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
protected $fillable = [
    'customer_id',
    'service_id',
    'staff_id',
    'booking_date',
    'booking_time',
    'amount',
    'status',
    'remarks',
];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}