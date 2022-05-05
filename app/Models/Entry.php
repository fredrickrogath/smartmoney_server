<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'category_id',
        'category_name',
        'budget_id',
        'balance',
        'user_id',
        'type'
    ];

    public function scopegetEntries($query, $budget_id)
    {
        return $query->where('user_id', Auth::user()->id)->where('budget_id', $budget_id)->get();
    }
}
