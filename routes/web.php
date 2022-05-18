<?php

use Illuminate\Support\Facades\Route;

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

    // $currentAmount = \App\Models\Entry::where('type', 'in')->where('budget_id', 2)->where('user_id', 2)->get();
    // // dd($currentAmount);
    // $amount = 0;
    // foreach ($currentAmount as $ca) {
    //     $amount += $ca->amount;
    // }

    // echo $amount;
    $test = \App\Models\Category::where('user_id', 1)->where('type', 'expense')->where('id', 3)->get();
    echo $test[0]->estimated_amount;
});
