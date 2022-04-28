<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            Category::create([
                'name' => 'Salary',
                'amount' => '20,000',
                'type' => 'income',
                'user_id' => Auth::user()->id,
            ]);

            Category::create([
                'name' => 'Boom',
                'amount' => '500,000',
                'type' => 'income',
                'user_id' => Auth::user()->id,
            ]);

            Category::create([
                'name' => 'Msalato nyama',
                'amount' => '80,000',
                'type' => 'expense',
                'user_id' => Auth::user()->id,
            ]);

            Category::create([
                'name' => 'UJAS bill',
                'amount' => '100,000',
                'type' => 'expense',
                'user_id' => Auth::user()->id,
            ]);

            $message = 'successfully created';
            $budget_id = $created->id;
            $code = 200;
        } else {
            $message = 'failed';
            $code = 400;
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
            'amount' => request()->amount,
            'type' => request()->type,
            'user_id' => Auth::user()->id,
        ]);

        if ($created) {
            $message = 'successfully created';
            $code = 200;
        } else {
            $message = 'failed';
            $code = 400;
        }

        return response()->json([
            'message' => $message,
            'code' => $code,
        ]);
    }

    public function deleteCategory()
    {
        $created = Category::deleteCategory(request()->id);

        if ($created) {
            $message = 'successfully deleted';
            $code = 200;
        } else {
            $message = 'failed';
            $code = 400;
        }

        return response()->json([
            'message' => $message,
            'code' => $code,
        ]);
    }

    public function getExpense()
    {
        $expeses = Category::expenseDescending();

        if ($expeses) {
            $expeses = $expeses;
            $code = 200;
        } else {
            $message = 'failed';
            $code = 400;
        }

        return response()->json([
            'data' => $expeses,
            'code' => $code,
        ]);
    }

    public function getIncome()
    {
        $expeses = Category::incomeDescending();

        if ($expeses) {
            $message = $expeses;
            $code = 200;
        } else {
            $message = 'failed';
            $code = 400;
        }

        return response()->json([
            'data' => $expeses,
            'code' => $code,
        ]);
    }

    public function selectCategory()
    {
        $category = Category::selectCategory(request()->categoryId);

        if ($category) {
            $message = 'successfully selected';
            $code = 200;
        } else {
            $message = 'failed';
            $code = 400;
        }

        return response()->json([
            'data' => $message,
            'code' => $code,
        ]);
    }

    public function getBudgetCategorizedByDay()
    {
        $data = Budget::where('created_at', '>=', Carbon::now()->subMonth())
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('* as "views"'),
            ));

        return response()->json([
            'data' => $data,
        ]);
    }
}
