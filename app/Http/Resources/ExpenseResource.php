<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'status' => $this->status,
            'remarks' => $this->remarks,
            'uer_id' => $this->user_id,
            'expense_category_id' => $this->expense_category_id,
            'amount' =>$this->amount,
            'description' =>$this->description,
            'description' =>$this->description,
            'image_url' => $this->image_url,
            // 'expenses'   => expenseResource::collection($this->expenses),
            'created_at'=> $this->created_at->diffForHumans(),
        ];
    }
}
