<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
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
            $budget_id = $created->id;
            $code = 200;
        } else {
            $message = 'failed';
            $code = 203;
        }

        return response()->json([
            'message' => $message,
            'budget_id' => $budget_id,
            'code' => $code,
        ]);
    }

    public function addCategory()
    {
        $created = Category::create([
            'name' => request()->name,
            'type' => request()->type,
            'budget_id' => request()->budget_id,
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

    public function getExpense()
    {
        $expeses = Category::where('type', 'expense')->get();

        if ($expeses) {
            $expeses = $expeses;
            $code = 200;
        } else {
            $message = 'failed';
            $code = 203;
        }

        return response()->json([
            'data' => $expeses,
            'code' => $code,
        ]);
    }

    public function getIncome()
    {
        $expeses = Category::where('type', 'income')->get();

        if ($expeses) {
            $expeses = $expeses;
            $code = 200;
        } else {
            $message = 'failed';
            $code = 203;
        }

        return response()->json([
            'data' => $expeses,
            'code' => $code,
        ]);
    }
}
