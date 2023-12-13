<?php

namespace App\Http\Resources\Room;

use App\Http\Resources\Facility\FacilityResource;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'name' => $this->name,
            'description'=> $this->description,
            'poster_url'=> $this->poster_url,
            'floor_area'=> $this->floor_area,
            'type'=> $this->type,
            'price'=> $this->price,
            'hotel_id'=> $this->hotel_id,
            'hotel_name'=> $this->hotel_name,
            'facilities'=>$this->facilities,
         //   'facilities' => FacilityResource::collection($this->whenLoaded('facilities')),
        ];
    }
}
