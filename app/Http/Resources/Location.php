<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\City;
use App\Http\Resources\City as CityResource;

class Location extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'lat' => $this->name,
            'lon' => $this->description,
            'name' => $this->name,
            'area' => $this->area,
            'city' => new CityResource(City::find($this->city_id)),
            'district' => $this->district
        ];
    }
}
