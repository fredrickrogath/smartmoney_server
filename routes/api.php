<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API route for register new user
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/createBudget', [\App\Http\Controllers\BudgetController::class, 'createBudget']);

    Route::post('/addCategory', [\App\Http\Controllers\BudgetController::class, 'addCategory']);

    Route::post('/getExpense', [\App\Http\Controllers\BudgetController::class, 'getExpense']);

    Route::post('/getIncome', [\App\Http\Controllers\BudgetController::class, 'getIncome']);

    Route::post('/deleteCategory', [\App\Http\Controllers\BudgetController::class, 'deleteCategory']);

    Route::post('/selectCategory', [\App\Http\Controllers\BudgetController::class, 'selectCategory']);

    Route::post('/getBudgetCategorizedByDay', [\App\Http\Controllers\BudgetController::class, 'getBudgetCategorizedByDay']);

    Route::post('/addEntry', [\App\Http\Controllers\BudgetController::class, 'addEntry']);

    Route::post('/getCashInCategoryLists', [\App\Http\Controllers\BudgetController::class, 'getCashInCategoryLists']);

    Route::post('/getCashOutCategoryLists', [\App\Http\Controllers\BudgetController::class, 'getCashOutCategoryLists']);

    Route::post('/getEntries', [\App\Http\Controllers\BudgetController::class, 'getEntries']);

    Route::post('/totalIn', [\App\Http\Controllers\BudgetController::class, 'totalIn']);

    Route::post('/totalOut', [\App\Http\Controllers\BudgetController::class, 'totalOut']);

    Route::post('/createNewBudget', [\App\Http\Controllers\BudgetController::class, 'createNewBudget']);

    Route::post('/budgetList', [\App\Http\Controllers\BudgetController::class, 'budgetList']);

    Route::post('/updateCategory', [\App\Http\Controllers\BudgetController::class, 'updateCategory']);

    // API route for logout user
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});
