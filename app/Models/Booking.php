<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = ['user_id','room_id','booking_date','start_time','end_time','status'];

    public function ruangan() {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
    public function oleh() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
