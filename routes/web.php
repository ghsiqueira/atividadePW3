<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgeController;
use App\Http\Controllers\MyNameController;
use App\Http\Controllers\CalculatorController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello/{name}', [MyNameController::class, 'hello'])->where('nome', '[A-Z][a-z]{2,}')->name('hello'); 

Route::get('/conta/{numero1}/{numero2}/{operacao?}', [CalculatorController::class, 'operacao']);

Route::get('/idade/{ano}/{mes?}/{dia?}', [AgeController::class, 'idade'])->where(['ano' => '[0-9]{4}', 'mes' => '[0-9]{1,2}', 'dia' => '[0-9]{1,2}']);