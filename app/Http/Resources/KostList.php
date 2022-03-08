<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KostList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $kost_owner = $this->kostOwner->first_name." ".$this->kostOwner->last_name;
        if($this->type->id == 1){
            $type = '<p><span class="badge badge-success">Putra</span></p>';
        }elseif($this->type->id == 2){
            $type = '<p><span class="badge badge-danger">Putri</span></p>';
        }else{
            $type = '<p><span class="badge badge-warning">Campur</span></p>';
        }
        $no = $request;
        return [
            'id' => $this->id,
            'no' => $no,
            'name' => $this->name,
            'address' =>  $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'type_id' => $this->type_id,
            'type' => $type,
            'kost_owner' => $kost_owner
        ];
    }
}
