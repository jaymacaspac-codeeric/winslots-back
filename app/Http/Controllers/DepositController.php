<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DepositController extends Controller
{
    public function pendingDeposit() {
        return view('deposits.pending');
    }

    public function pendingDepositList() {
        if(session('agent_id') == '2838' && session('admin_type') == 1) {
            $pending_deposits = DB::table('info_deposit')
            ->where('status', '0')
            ->get();
        } else {
            $pending_deposits = DB::table('info_deposit as d')
            ->join('info_users as u', 'd.user_id', 'u.user_id')
            ->where('u.agent_id', session('agent_id'))
            ->where('d.status', '0')
            ->get();
        }

        $totalRecords = count($pending_deposits);

        return $pending_deposits;
    }

    public function agentRequestDeposit(Request $request) {
        // $request_deposit = Http::withHeaders(['x-api-key' => '6VKQSZK-NZB4NH8-M5NNK0E-JWTPX7Q'])->post('https://api.nowpayments.io/v1/payment', [
        //     'price_amount'          => $_POST['deposit_amount'],
        //     'price_currency'        => 'usd',
        //     'pay_currency'          => $_POST['method'],
        //     'ipn_callback_url'      => 'https://sgminfo.co.kr/post/payment',
        //     'order_id'              => session('username'),
        //     'order_description'     => 'Deposit Request'
        // ]);

        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $string = str_shuffle($pin);

        $test = [
            "payment_id" => "5929791551", 
            "payment_status" => "waiting", 
            "pay_address" => $string, 
            "price_amount" => 100, 
            "price_currency" => "usd", 
            "pay_amount" => 0.00328014, 
            "amount_received" => 0.0032183, 
            "pay_currency" => "BTC", 
            "order_id" => "agent1", 
            "order_description" => "Deposit Request", 
            "ipn_callback_url" => "https://sgminfo.co.kr/post/payment", 
            "created_at" => "2022-06-03T08:22:39.061Z", 
            "updated_at" => "2022-06-03T08:22:39.061Z", 
            "purchase_id" => "4633294764", 
            "smart_contract" => null, 
            "network" => "btc", 
            "network_precision" => null, 
            "time_limit" => null, 
            "burning_percent" => null
        ];

        $deposit = DB::table('info_deposit')->insert([
            'transaction_id'    => str_pad(session('id'), 7, "0", STR_PAD_LEFT),
            'user_id'           => session('agent_id'),
            'username'          => session('username'),
            'transaction_type'  => 'deposit',
            'amount'            => $request->deposit_charge_amount,
            'krw_amount'        => $request->deposit_amount,
            'payment_method'    => $request->method,
            'user_type'         => 2,
            'status'            => 2,  // 1:success, 2:pending, 3:cancel
            'created_at'        =>  date("Y-m-d\TH:i:s\Z", strtotime(Carbon::now()))
        ]);

        // return $request_deposit;
        return $test;
    }

}