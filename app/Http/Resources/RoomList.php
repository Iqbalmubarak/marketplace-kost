<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {      
        if($this->status == 0){
            $status = '<p><span class="badge badge-primary">Tersedia</span></p>';
        }elseif($this->status == 1){
            $status = '<p><span class="badge badge-danger">Terisi</span></p>';
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'room_type_id' => $this->room_type_id,
            'wide' => $this->roomType->lenght.' x '.$this->roomType->wide,
            'room_type' => $this->roomType->name,
            'e_status' => $this->status,
            'status' => $status
        ];
    }
}
