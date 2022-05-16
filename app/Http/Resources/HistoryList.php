<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DateTime;

class HistoryList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $today = new DateTime("today");
        $ended = new DateTime($this->rent->ended()->ended_at);
        if($today < $ended){
            $status = '<span class="label label-primary"> Berjalan</span>';
        }else{
            $status = '<span class="label label-danger"> Selesai</span>';
        }

        return [
            'id' => $this->id,
            'kost' => $this->rent->room->roomType->kost->name,
            'room' => $this->rent->room->name,
            'started_at' => $this->rent->started()->started_at,
            'ended_at' => $this->rent->ended()->ended_at,
            'status' => $status
        ];
    }
}
