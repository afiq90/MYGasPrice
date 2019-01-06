<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'last_week_price' => $this->last_week_price,
             'current_price' => $this->current_price,
             'isIncrease' => $this->isIncrease,
             'petrol_type' => $this->petrol_type,
             'brand_name' => $this->brand_name,
             'note' => $this->note,
        ];
    }
}
