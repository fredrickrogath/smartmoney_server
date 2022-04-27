<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'amount',
        'user_id',
    ];

    public function scopeincomeDescending($query)
    {
        return $query->where('type', 'income')->orderBy('id', 'DESC')->get();
    }

    public function scopeexpenseDescending($query)
    {
        return $query->where('type', 'expense')->orderBy('id', 'DESC')->get();
    }

    public function scopedeleteCategory($query, $id)
    {
        return $query->find($id)->delete();
    }
}
