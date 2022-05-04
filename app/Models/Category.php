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
        'in_use'
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
        return $query->where('id', '=', $categoryId)->where('user_id', Auth::user()->id)->update(['in_use' => '1']);
    }

    public function scopegetCategories($query)
    {
        return $query->where('user_id', Auth::user()->id)->get();
    }
}
