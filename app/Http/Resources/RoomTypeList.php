<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomTypeList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {     
        return [
            'id' => $this->roomType->id,
            'name' => $this->roomType->name,
            'wide' => $this->roomType->lenght.' x '.$this->roomType->wide,
            'total' => $this->total
        ];
    }
}
