<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = $this->kostSeeker->first_name." ".$this->kostSeeker->last_name;
        if($this->status == 1){
            $status = '<p><span class="badge badge-plain">Sedang Diajukan</span></p>';
        }elseif($this->status == 2){
            $status = '<p><span class="badge badge-success">Diterima</span></p>';
        }else{
            $status = '<p><span class="badge badge-danger">Ditolak</span></p>';
        }

        $total_price = "Rp. ".number_format($this->total_price, 0, ',', '.'). ",00";

        return [
            'id' => $this->id,
            'room_type' => $this->roomType->name,
            'room_type_id' => $this->room_type_id,
            'kost' => $this->roomType->kost->name,
            'kost_seeker' => $name,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'status' => $status,
            'this_status' => $this->status,
            'total_price' => $total_price
        ];
    }
}
