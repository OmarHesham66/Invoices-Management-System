<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            // 'id'=>$this->id,
            // 'id'=>$this->id,
            // 'id'=>$this->id,
            // 'id'=>$this->id,
            // 'id'=>$this->id,
        ];
    }
}
