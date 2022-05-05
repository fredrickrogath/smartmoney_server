<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');

    $previousAmount = Balance::where('budget_id', 6)->where('user_id', 4)->get('amount')[0];
// dd($previousAmount->amount);
        // if ($type == 'in') {
            $currentAmount = $previousAmount->amount + 1000;
        // } elseif ($type == 'out') {
        //     $currentAmount = (int)$previousAmount - (int)$amount;
        // }

        return $currentAmount;
});
