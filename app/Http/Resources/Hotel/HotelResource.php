<?php

namespace App\Http\Resources\Hotel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hotel_name' => $this->hotel_name,
            'description'=> $this->description,
            'poster_url'=> $this->poster_url,
             'address'=> $this->address,
            'facilities'=>$this->facilities,
        ];
    }
}



