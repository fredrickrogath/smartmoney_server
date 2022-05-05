<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'budget_id',
        'user_id',
    ];

    public function scopecreateNew($query, $amount, $budgetId)
    {
        $created = Balance::create([
            'amount' => $amount,
            'budget_id' => $budgetId,
            'user_id' => Auth::user()->id,
        ]);
        return $created;
    }

    public function scopegetBalance($query, $budgetId)
    {
        $currentAmount = $query->where('budget_id', $budgetId)->where('user_id', Auth::user()->id)->get()[0];
        return $currentAmount->amount;
    }

    public function scopeupdateCurrent($query, $amount, $budgetId, $type)
    {
        $previousAmount = $query->where('budget_id', $budgetId)->where('user_id', Auth::user()->id)->get('amount')[0]->amount;

        if ($type == 'in') {
            $currentAmount = $previousAmount + $amount;
        } elseif ($type == 'out') {
            $currentAmount = $previousAmount - $amount;
        }

        $query->where('budget_id', $budgetId)->where('user_id', Auth::user()->id)->update(['amount' => $currentAmount]);

        return $currentAmount;
    }
}
