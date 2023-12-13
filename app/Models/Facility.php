<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class,'facility_room','facility_id','room_id');
    }

    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class,'facility_hotel','facility_id','hotel_id');
    }

}
