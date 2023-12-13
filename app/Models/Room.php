<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'poster_url',
        'floor_area',
        'type',
        'price',
        'hotel_id'
    ];

    public function hotel():BelongsTo
    {
        return $this->belongsTo(Hotel::class,'hotel_id', 'id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class,'facility_room','room_id','facility_id');
    }
}
