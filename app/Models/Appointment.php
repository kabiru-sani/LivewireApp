<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected  $casts = [
        'date' => 'datetime',
        'time' => 'datetime',
        'members' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

// to make the badges color dynamic
    public function getStatusBadgeAttribute ()
    {
        $badges = [
            'SCHEDULED' => 'primary',
            'CLOSED' => 'success',
        ];
        return $badges [$this->status];
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDate();
    }

    public function getTimeAttribute($value)
    {
        return Carbon::parse($value)->toFormattedTime();
    }
}
