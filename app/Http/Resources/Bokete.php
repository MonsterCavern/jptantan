<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Bokete extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        dd($this);

        return parent::toArray($request);
    }
}
