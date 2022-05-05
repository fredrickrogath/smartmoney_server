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
        'type',
    ];

    public function scopegetEntries($query, $budget_id)
    {
        return $query->where('user_id', Auth::user()->id)->where('budget_id', $budget_id)->get();
    }

    public function scopetotalIn($query, $budget_id)
    {
        $currentAmount = $query->where('type', 'in')->where('user_id', Auth::user()->id)->where('budget_id', $budget_id)->get();
        $amount = 0;
        foreach ($currentAmount as $ca) {
            $amount += $ca->amount;
        }

        return $amount;
    }

    public function scopetotalOut($query, $budget_id)
    {
        return $query->where('user_id', Auth::user()->id)->where('budget_id', $budget_id)->get();
    }
}
