<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DepositController extends Controller
{
    public function pendingDeposit(Request $request) {
        if($request->session()->has('username')) {
           return view('deposits.pending');
        } else {
            return redirect('/');
        }
    }

    public function pendingDepositList() {
        if(session('agent_id') == '2838' && session('admin_type') == 1) {
            $pending_deposits = DB::table('info_deposit as d')
                            ->leftJoin('info_agent as a', 'd.user_id', 'a.agent_id')
                            ->leftJoin('info_users as u', 'd.user_id', 'u.user_id')
                            ->select('d.*', 'a.agent_uname', 'a.agent_name', 'a.agent_nick', 'u.username as player_name', 'u.nickname as player_nick', 'u.firstname as player_firstname', 'u.lastname as player_lastname')
                            ->where('d.status', '2')
                            ->get();
        } else {
            $pending_deposits = DB::table('info_deposit as d')
                            ->leftJoin('info_agent as a', 'd.user_id', 'a.agent_id')
                            ->leftJoin('info_users as u', 'd.user_id', 'u.user_id')
                            ->where('u.agent_id', session('agent_id'))
                            ->where('a.parent', session('agent_id'))
                            ->where('d.status', '2')
                            ->get();
        }

        return $pending_deposits;
    }

    public function depositCaptcha() {
        
        return loadCustomCaptcha();
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

        $this->validateDeposit($request);

        if(isset($request->captcha)){
            if(!captchaVerify($request->captcha, $request->captcha_secret)){
                $notify[] = ['error',"Invalid captcha"];
                return 'Invalid captcha';
            } else {
                $deposit = DB::table('info_deposit')->insert([
                    // 'transaction_id'    => getTrx() . time() . session('id'),
                    'transaction_id'    => strtoupper(uniqid('DP')).session('id'),
                    'user_id'           => session('agent_id'),
                    'username'          => session('username'),
                    'transaction_type'  => 'deposit',
                    'request_amount'    => (float) str_replace(',', '', $request->deposit_charge_amount),
                    'krw_amount'        => (float) str_replace(',', '', $request->deposit_amount),
                    'payment_method'    => $request->method,
                    'user_type'         => 2,
                    'status'            => 2,  // 1:success, 2:pending, 3:cancel
                    'created_at'        => date("Y-m-d\TH:i:s\Z", strtotime(Carbon::now()))
                ]);

                return $request;
                // return captchaVerify($request->captcha, $request->captcha_secret);
            }
        }
    }

    protected function validateDeposit(Request $request)
    {
        $validation_rule = [
            'deposit_charge_amount' => 'required',
            'deposit_amount' => 'required',
            'method' => 'required',
        ];

        $validation_rule['captcha'] = 'required';

        $request->validate($validation_rule);

    }

    public function approve(Request $request) {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $deposit = DB::table('info_deposit')
                ->where('id', $request->id)
                ->where('status', 2)
                ->update(['statuse' => 1]);
        if($deposit) {
            $details = DB::table('info_deposit')
                    ->where('id', $request->id)
                    ->first();

            $user = DB::table('info_user')
                ->where('user_id', $details->user_id)
                ->where('user_type', $details->user_type)
                ->update(['balance' => $details->request_amount]);
            
            $log = DB::table('log_deposit')->insert([
                'approved_by'       => session('agent_id'),
                'transaction_id'    => $details->transaction_id,
                'target_user'       => $details->user_id,
                'user_type'         => $details->user_type,
                'request_amount'    => $details->request_amount,
                'details'           => 'Deposit Via ' . $details->payment_method,
                'created_at'        =>  date("Y-m-d\TH:i:s\Z", strtotime(Carbon::now()))
            ]);
        }

        $notify[] = ['success', 'Deposit request has been approved.'];
        return redirect()->route('deposits.pending')->withNotify($notify);
    }

    public function reject(Request $request) {
        
    }

}