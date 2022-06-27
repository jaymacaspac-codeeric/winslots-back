<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AccountSettingsController extends Controller
{
    public function index(Request $request) {
        if($request->session()->has('username')) {
            $admin = DB::table('info_agent')
                    ->where('agent_id', session('agent_id'))
                    ->first();

            $affiliated_agents = [];

            if(session('agent_id') != '2838' && session('admin_type') != 1) {
                for($x=0; $x < $admin->level; $x++) {
                    $arr = array();   
                    if(!($affiliated_agents)){
                        $arr = DB::table('info_agent')
                            ->where('agent_id', $admin->parent)
                            ->first();          
                    } else {
                        $arr = DB::table('info_agent')
                            ->where('agent_id', $affiliated_agents[$x - 1]->parent)
                            ->first(); 
                    }
    
                    $affiliated_agents[] = $arr;
                }
            } else {
                // $arr = array();   
                // $arr = null;
                // $affiliated_agents[] = $arr;
            }

            $check_agent_method = DB::table('set_agent_payment')
                                ->where('agent_id', session('agent_id'))
                                ->count();
            if($check_agent_method > 0) {
                $payment_method = DB::table('set_agent_payment as p')
                                ->join('gateway_currencies as c', 'p.gateway_id', 'c.id')
                                ->where('c.status', 1)
                                ->where('p.agent_id', session('agent_id'))
                                ->get();
            } else {
                $payment_method = DB::table('gateway_currencies')
                                ->where('status', 1)
                                ->get();
            }

            // $payment_method = DB::table('gateway_currencies as c')
            //                 ->leftJoin('set_agent_payment as p', 'c.id', 'p.gateway_id')
            //                 ->where('c.status', 1)
            //                 ->where('p.agent_id', session('agent_id'))
            //                 ->get();

            // $payment_method = DB::table('set_agent_payment as p')
            //                 ->join('gateway_currencies as c', 'p.gateway_id', 'c.id')
            //                 ->where('c.status', 1)
            //                 ->where('p.agent_id', session('agent_id'))
            //                 ->get();

            return view('account_settings.index', compact('admin', 'affiliated_agents', 'payment_method'));
        } else {
            return redirect('/');
        }
    }

    public function saveDepositingMethod(Request $request) {
        if ($request->has('address')) {
            for ($a = 0; $a < count($request->address); $a++) {
                // if($request->address[$a]['value'] != "") {
                    $method = DB::table('set_agent_payment')->updateOrInsert([
                        'gateway_id' => $request->address[$a]['id'],
                        'agent_id' => session('agent_id'),
                        'status' => 1
                    ], ['parameter' => $request->address[$a]['value']]);
                // }
            }
        }

        $notify[] = ['success', 'Payment gateway has been added.'];
        
        return $notify;
    }
}
