<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    public function index(Request $request) {
        if($request->session()->has('username')) {
            return view('commission.index');
        } else {
            return redirect('/');
        }
    }

    public function betResult() {
        if(session('agent_id') == '2838' && session('admin_type') == 1) {
            $bet = DB::table('info_bets_honorlink as a')
                ->join('info_bets_honorlink as b', 'b.referer_id', 'a.transaction_id')
                ->leftJoin('info_users as u', 'u.username', 'a.username')
                ->leftJoin('info_admin as g', 'g.agent_id', 'u.agent_id')
                ->select('a.*', 'b.amount as win_amount', 'b.balance as win_balance', 'b.transaction_type as transaction_type_result', 'u.agent_id as agent_id')
                ->whereMonth('a.processed_at', date('m'))
                ->get();
        } else {
            $bet = DB::table('info_bets_honorlink as a')
                ->join('info_bets_honorlink as b', 'b.referer_id', 'a.transaction_id')
                ->join('info_users as u', 'u.username', 'a.username')
                ->select('a.*', 'b.amount as win_amount', 'b.balance as win_balance', 'b.transaction_type as transaction_type_result')
                ->whereMonth('a.processed_at', date('m'))
                ->get();
        }

        return $bet;
    }
}
