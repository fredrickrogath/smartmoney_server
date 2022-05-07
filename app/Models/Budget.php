<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'user_id'
    ];

    public function scopebudgetDescending($query)
    {
        return $query->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
    }
}
