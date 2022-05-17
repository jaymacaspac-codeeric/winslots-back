<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BetController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BetHistoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
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

// Route::get('/member', 'MemberController@index');

// Route::get('/member/create', 'MemberController@memberCreate');

Route::get('/member/confirmation', [MemberController::class, 'memberConfirmation']);
Route::get('/balance', [MemberController::class, 'balanceCheck']);

Route::get('/bet', [BetController::class, 'bet']);
Route::get('/bet/result', [BetController::class, 'betResult']);
Route::get('/bet/refund', [BetController::class, 'betRefund']);


// Route::get('/', function () {
//     return view('login/index');
// });

Route::get('/', [AuthController::class, 'index']);
// Route::post('/login', [AuthController::class, 'login']);

Route::post('/login', [MainController::class, 'login']);
Route::post('/logout', [MainController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/user-list', [UserController::class, 'userList'])->name('user.list');
Route::get('/user-list/{username}', [UserController::class, 'getUserInfo'])->name('user.info');
Route::get('/get-user-list', [UserController::class, 'getUserList']);
Route::get('/bet-history/user', [UserController::class, 'userBetHistory'])->name('user.bet');

Route::get('/bet-history', [BetHistoryController::class, 'index'])->name('bet.index');
Route::get('/bet-history/list', [BetHistoryController::class, 'betHistoryList'])->name('bet.history');
Route::get('/bet-history/details', [BetHistoryController::class, 'betHistoryDetails'])->name('bet.details');

Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/list', [TransactionController::class, 'transactionList'])->name('transaction.list');