<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

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
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\SettingsController;

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
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    Cache::flush();
    cache()->flush();
    return 'DONE';
});

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
Route::get('/logout', [MainController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/profit-loss', [DashboardController::class, 'profitLoss'])->name('profit.loss');

// USER
Route::get('/user-list', [UserController::class, 'userList'])->name('user.list');
Route::get('/pending-user', [UserController::class, 'pendingUser'])->name('user.pending.index');
Route::get('/deactivated-user', [UserController::class, 'deactivatedUser'])->name('user.deactivated.index');
Route::get('/user-list/{username}', [UserController::class, 'getUserInfo'])->name('user.info');
Route::get('/get-user-list', [UserController::class, 'getUserList']);
Route::get('/bet-history/user', [UserController::class, 'userBetHistory'])->name('user.bet');
Route::post('/recharge', [UserController::class, 'userRecharge']);
Route::post('/collect', [UserController::class, 'userCollect']);

Route::get('/check-user/{username}', [UserController::class, 'checkUser']);
Route::post('/create-user', [UserController::class, 'createUser']);

Route::get('/bet-history', [BetHistoryController::class, 'index'])->name('bet.index');
Route::get('/bet-history/list', [BetHistoryController::class, 'betHistoryList'])->name('bet.history');
Route::get('/bet-history/details', [BetHistoryController::class, 'betHistoryDetails'])->name('bet.details');

Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transaction/list', [TransactionController::class, 'transactionList'])->name('transaction.list');
Route::post('/transaction/log', [TransactionController::class, 'transactionLog'])->name('transaction.log');

//PAYMENT METHOD
Route::get('/payment/method', [PaymentGatewayController::class, 'index'])->name('payment.index');
Route::get('/payment/method/list', [PaymentGatewayController::class, 'list'])->name('payment.list');
Route::get('/payment/method/new', [PaymentGatewayController::class, 'create'])->name('payment.create');
Route::post('/payment/method/save', [PaymentGatewayController::class, 'save'])->name('payment.save');
Route::post('/payment/method/status', [PaymentGatewayController::class, 'status'])->name('payment.status');
Route::post('/payment/method/delete}', [PaymentGatewayController::class, 'delete'])->name('payment.delete');
Route::get('/payment/method/edit/{id}', [PaymentGatewayController::class, 'edit'])->name('payment.edit');
Route::post('/payment/method/update/{id}', [PaymentGatewayController::class, 'update'])->name('payment.update');

// AGENT
Route::get('/agent', [AgentController::class, 'index'])->name('agent.index');
Route::get('/agent-list', [AgentController::class, 'agentList'])->name('agent.list');
Route::get('/agent/{username}', [AgentController::class, 'agentInfo'])->name('agent.info');
Route::get('/create-agent', [AgentController::class, 'createAgent'])->name('agent.create');
Route::post('/save-agent', [AgentController::class, 'saveAgent'])->name('agent.save');
Route::post('/check-duplicate-agent', [AgentController::class, 'checkAgentDuplicate'])->name('agent.duplicate');
Route::get('/agent-tree', [AgentController::class, 'populateAgentTree'])->name('agent.tree');

// DEPOSIT AND WITHDRAW
Route::post('/deposit/request', [DepositController::class, 'agentRequestDeposit'])->name('deposit.request');
Route::get('/deposit/pending', [DepositController::class, 'pendingDeposit'])->name('deposit.pending');
Route::get('/deposit/pending/list', [DepositController::class, 'pendingDepositList'])->name('deposit.pending.list');
Route::get('/deposit/approved', [DepositController::class, 'approvedDeposit'])->name('deposit.approved');
Route::get('/deposit/rejected', [DepositController::class, 'rejectedDeposit'])->name('deposit.rejected');
Route::get('/deposit/log', [DepositController::class, 'logDeposit'])->name('deposit.log');
Route::post('/deposit/approve', [DepositController::class, 'approve'])->name('deposit.approve');
Route::post('/deposit/reject', [DepositController::class, 'reject'])->name('deposit.reject');

Route::post('/witdrawals/request', [DepositController::class, 'agentRequestWitdrawals'])->name('withdrawals.request');
Route::get('/witdrawals/pending', [DepositController::class, 'pendingWitdrawals'])->name('withdrawals.pending');
Route::get('/witdrawals/approved', [DepositController::class, 'approvedWitdrawals'])->name('withdrawals.approved');
Route::get('/witdrawals/rejected', [DepositController::class, 'rejectedWitdrawals'])->name('withdrawals.rejected');
Route::get('/witdrawals/log', [DepositController::class, 'logWitdrawals'])->name('withdrawals.log');

//REPORTS
Route::get('/commission', [CommissionController::class, 'index'])->name('commission.index');
Route::get('/commission/bet', [CommissionController::class, 'betResult'])->name('commission.bet');

Route::get('placeholder-image/{size}', [SiteController::class, 'placeholderImage'])->name('placeholder.image');

//SETTINGS
Route::post('/account/settings/address/save', [AccountSettingsController::class, 'saveDepositingMethod'])->name('method.save');
Route::get('/account/settings', [AccountSettingsController::class, 'index'])->name('account.settings');
Route::get('/settings/general', [SettingsController::class, 'generalSettings'])->name('settings.general');
Route::post('/settings/general', [SettingsController::class, 'updateGeneralSettings'])->name('settings.general.update');