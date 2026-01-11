<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status'  => 'required|in:approved,rejected',
            'remarks' => 'required_if:status,rejected|string|max:500',
        ];
    }

    public function message(): array
    {
        return [
            'status.required' => 'Status is required',
            'status.in' => 'Status must be approved or rejected',
            'remarks.required_if' => 'Remarks are required when rejecting an expense'
        ];
    }
}
