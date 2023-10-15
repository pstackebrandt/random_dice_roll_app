<?php
// file name: routes/web.php

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

/**
 * Call start page.
 * Show the dice roller form with initial values.
 */
Route::get('/', [DiceController::class, 'showDiceRollerFormInitially']);

// Show the laravel documentation
Route::get('/doc', function () {
    return view('welcome');
});

/**
 * Show the dice roller form with initial values
 */
Route::get('/select-dice', [DiceController::class, 'showDiceRollerFormInitially']);

/**
 * Roll the dice and return the roll result to the dice roller view.
 */
Route::post('/roll-dice', [DiceController::class, 'rollDice']);
