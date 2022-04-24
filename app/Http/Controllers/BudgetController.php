<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    public function createBudget(){
       $created = Budget::create([
            'name' => request()->name,
            'start_date' => request()->start_date,
            'end_date' => request()->end_date,
            'user_id' => auth()->user()->id,
        ]);

        if($created){
            return response()->json([
                'message' => 'successfully created',
                'code' => 200,
            ]);
        }
    }
}
