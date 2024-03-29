<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RentList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->status == 1){
            $status = '<p><span class="badge badge-plain">Sedang Diajukan</span></p>';
        }elseif($this->status == 2){
            $status = '<p><span class="badge badge-success">Diterima</span></p>';
        }else{
            $status = '<p><span class="badge badge-danger">Ditolak</span></p>';
        }
        return [
            'id' => $this->id,
            'kost' => $this->room->roomType->kost->name,
            'room' => $this->room->name,
            'type' => $this->room->roomType->name,
            'status' => $status
        ];
    }
}
