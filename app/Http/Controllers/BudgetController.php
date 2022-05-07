<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Entry;
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

    public function createNewBudget()
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
            $code = 400;
        }

        return response()->json([
            'message' => $message,
            'budget_id' => $budget_id,
            'code' => $code,
        ]);
    }

    public function budgetList()
    {
        $expeses = budget::budgetDescending();

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

    public function addEntry()
    {
        $type = request()->type;

        $amount = request()->amount;

        $budgetId = request()->budget_id;

        $balance = Balance::getBalance($budgetId);

        if ($type == 'in') {

            if ($balance == '0.0') {
                $balance = $amount;
                Balance::createNew($amount, $budgetId);
            } else {
                $balance = Balance::updateCurrent($amount, $budgetId, $type);
            }
        } elseif ($type == 'out') {

        }

        $created = Entry::create([
            'amount' => $amount,
            'balance' => $balance,
            'category_id' => request()->category_id,
            'category_name' => request()->category_name,
            'budget_id' => $budgetId,
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
            'balance' => $balance,
            'code' => $code,
        ]);
    }

    public function getCategories()
    {
        $categores = Category::getCategories();

        if ($categores) {
            $data = $categores;
            $code = 200;
        } else {
            $message = $data;
            $code = 400;
        }

        return response()->json([
            'data' => $categores,
            'code' => $code,
        ]);
    }

    public function getEntries()
    {
        $categores = Entry::getEntries(request()->budget_id);

        $balance = Balance::getBalance(request()->budget_id);

        if ($categores) {
            $data = $categores;
            $code = 200;
        } else {
            $message = $data;
            $code = 400;
        }

        return response()->json([
            'data' => $categores,
            'balance' => $balance,
            'code' => $code,
        ]);
    }

    public function totalIn()
    {
        $totalIn = Entry::totalIn(request()->budget_id);

        if ($totalIn) {
            $data = $totalIn;
            $code = 200;
        } else {
            $message = 'failed';
            $code = 400;
        }

        return response()->json([
            'data' => $data,
            'code' => $code,
        ]);
    }

    public function totalOut()
    {
        $totalOut = Entry::totalOut(request()->budget_id);

        if ($totalOut) {
            $data = $totalOut;
            $code = 200;
        } else {
            $message = $data;
            $code = 400;
        }

        return response()->json([
            'data' => -($data),
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
