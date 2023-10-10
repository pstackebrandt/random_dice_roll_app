<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Start dice select at default page
Route::get('/', [DiceController::class, 'showForm']);

// Show the larvel documentation
Route::get('/doc', function () {
    return view('welcome');
});

// Show the dice select form
Route::get('/select-dice', [DiceController::class, 'showForm']);

// Roll the dice
Route::post('/roll-dice', [DiceController::class, 'rollDice']);
