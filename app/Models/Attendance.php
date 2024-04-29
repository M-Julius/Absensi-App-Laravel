<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'user_id',
        'time_in',
        'time_out',
        'date',
        'latlong_in',
        'latlong_out',
    ];

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
