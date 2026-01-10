<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'expense_category_id',
        'amount',
        'description',
        'image_url',
        'status',
        'remarks',
    ];

    // Filter by status
    public function scopeStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    // Filter by category slug
    public function scopeCategory(Builder $query, string $slug)
    {
        return $query->whereHas('category', function ($q) use ($slug) {
            $q->where('slug', $slug);
        });
    }

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
