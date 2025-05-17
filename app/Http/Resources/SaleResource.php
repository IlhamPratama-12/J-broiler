<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'company_id' => $this->company_id,
            'date' => $this->date,
            'code' => $this->code,
            'partnership_id' => $this->partnership_id,
            'payment_method' => $this->payment_method,
            'total' => $this->total,
            'notes' => $this->notes,
            'partnership' =>  new PartnershipResource($this->partnership),
            'sale_details' =>  SaleDetailResource::collection($this->saleDetails)
        ];
    }
}
