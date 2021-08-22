<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
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
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::get('/dashboard', [HomeController::class, 'home'])->middleware(['auth'])->name('dashboard');

Route::post('payments/pay', [PaymentController::class, 'pay'])->name('pay');
Route::get('payments/approval', [PaymentController::class, 'approval'])->name('approval');
Route::get('payments/cancelled', [PaymentController::class, 'cancelled'])->name('cancelled');


require __DIR__.'/auth.php';
