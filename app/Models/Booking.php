<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'days',
        'price',
        'room_id',
        'user_id',
        'started_at',
        'finished_at'
    ];

  //  public function setStartedAtAttribute($value)
 //   {
 //       $this->attributes['started_at'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d H:i:s');
 //   }

 //   public function getStartedAtAttribute($value)
 //   {
 //       return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['started_at'])->format('d-m-Y H:i');
 //   }

 //   public function setFinishedAtAttribute($value)
//    {
//        $this->attributes['finished_at'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d H:i:s');
 //   }


    public function room():BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
