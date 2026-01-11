<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViewExpenseRequest extends FormRequest
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
            'status' => 'nullable|in:pending,approved,rejected',
            'category' => 'nullable|exists:expense_categories,slug',
        ];
    }

    public function message(): array
    {
        return [
            'status.in' => 'Invalid status filter. Allowed values: pending, approved, rejected.',
            'category.exists' => 'Invalid category filter. Please provide a valid category slug.',
        ];
    }
}
