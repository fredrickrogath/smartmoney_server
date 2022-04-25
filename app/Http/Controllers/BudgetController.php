<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function createBudget()
    {
        $created = Budget::create([
            'name' => request()->name,
            'start_date' => request()->start_date,
            'end_date' => request()->end_date,
            'user_id' => Auth::user()->id,
        ]);

        if ($created) {
            $message = 'successfully created';
            $code = 200;
        } else {
            $message = 'failed';
            $code = 203;
        }

        return response()->json([
            'message' => $message,
            'code' => $code,
        ]);
    }

    public function getCategory()
    {
        $created = Budget::create([
            'name' => request()->name,
            'start_date' => request()->start_date,
            'end_date' => request()->end_date,
            'user_id' => Auth::user()->id,
        ]);

        if ($created) {
            $message = 'successfully created';
            $code = 200;
        } else {
            $message = 'failed';
            $code = 203;
        }

        return response()->json([
            'message' => $message,
            'code' => $code,
        ]);
    }
}
