<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'amount',
        'user_id',
        'in_use',
        'estimated_amount',
    ];

    public function scopeincomeDescending($query)
    {
        return $query->where('type', 'income')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
    }

    public function scopeexpenseDescending($query)
    {
        return $query->where('type', 'expense')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
    }

    public function scopedeleteCategory($query, $id)
    {
        return $query->find($id)->delete();
    }

    public function scopeselectCategory($query, $categoryId)
    {
        return $query->where('id', $categoryId)->where('user_id', Auth::user()->id)->update(['in_use' => '1']);
    }

    public function scopegetCashInCategoryLists($query)
    {
        return $query->where('user_id', Auth::user()->id)->where('type', 'income')->get();
    }

    public function scopegetCashOutCategoryLists($query)
    {
        return $query->where('user_id', Auth::user()->id)->where('type', 'expense')->get();
    }

    public function scopeupdateCategory($query, $id, $name, $amount)
    {
        return $query->where('id', $id)->where('user_id', Auth::user()->id)->update(['name' => $name, 'amount' => $amount]);
    }

    public function scopeupdateEstimatedAmount($query, $id, $amount)
    {
        $estimated_amount = $query->where('user_id', Auth::user()->id)->where('type', 'expense')->where('id', $id)->get();
        $update = $estimated_amount[0]->estimated_amount += $amount;
        // try {
        //     $estimated_amount = $query->where('user_id', Auth::user()->id)->where('type', 'expense')->where('id', $id)->get()[0];
        //     $estimated_amount->estimated_amount += $amount;
        // } catch (\Exception $exception) {
        //     return response()->json([
        //         'error' => $exception->getMessage(),
        //     ]);
        // }
        return $query->where('user_id', Auth::user()->id)->where('type', 'expense')->where('id', $id)->update(['estimated_amount' => $update]);
    }
}
