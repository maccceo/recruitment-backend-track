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
            "tax_profile_id" => $this->tax_profile_id,
            "invoice_number" => $this->invoice_number,
            "issue_date" => $this->issue_date,
            "due_date" => $this->due_date,
            "total_amount" => $this->total_amount,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
