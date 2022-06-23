<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request) {

        // if(Auth::check()){
        //     return view('dashboard.index', array(
        //         'info' => $this->getAgentInfo(),
        //         'totalBalance' => $this->getTotalUserBalance(),
        //         'dataCount' => $this->dataCounts()
        //     ));
        // }
  
        // return redirect("/")->with('fail', 'You are not allowed to access');

        if($request->session()->has('username')) {
            // dd($this->getAgentInfo());
            
            // $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            // $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
            // $dataCounts = $this->dataCounts();
            if(session('agent_id') == '2838' && session('admin_type') == 1) {
                $total_players  = DB::table('info_users')
                                ->where('status', '1')
                                ->count();

                $total_agents = DB::table('info_agent')
                                ->where('status', '1')
                                ->count();
                $total_bets_today = DB::table('info_bets_honorlink')
                                    ->where('transaction_type', 'bet')
                                    ->whereDate('processed_at', DB::raw('CURDATE()'))
                                    ->count();
                $total_player_betting = DB::table('info_bets_honorlink')
                                    // ->where('transaction_type', 'bet')
                                    ->whereDate('processed_at', DB::raw('CURDATE()'))
                                    ->groupBy('username')
                                    ->count();
                $pending_deposits = DB::table('info_deposit')
                                    ->where('status', 2)
                                    ->count();
                $pending_withdrawals = DB::table('info_withdrawals')
                                    ->where('status', '0')
                                    ->count();

                $total_deposits['amount'] = DB::table('info_deposit')
                                ->where('status', 1)
                                ->sum('request_amount');
                $total_deposits['krw_amount'] = DB::table('info_deposit')
                                ->where('status', 1)
                                ->sum('krw_amount');
                $total_deposits['usd_amount'] = DB::table('info_deposit')
                                ->where('status', 1)
                                ->sum('usd_amount');
            } else {
                $total_players = DB::table('info_users')
                                ->where('agent_id', session('agent_id'))
                                ->where('status', '1')
                                ->count();

                $total_agents = DB::table('info_agent')
                                ->where('affiliated_agent', session('agent_id'))
                                ->where('status', '1')
                                ->count();

                $total_bets_today = DB::table('info_bets_honorlink as b')
                                ->join('info_users as u', 'b.target_id', 'u.user_id')
                                ->where('b.transaction_type', 'bet')
                                ->where('u.agent_id', session('agent_id'))
                                ->whereDate('b.processed_at', DB::raw('CURDATE()'))
                                ->count();
                $total_player_betting = DB::table('info_bets_honorlink as b')
                                    ->join('info_users as u', 'b.target_id', 'u.user_id')
                                    // ->where('b.transaction_type', 'bet')
                                    ->where('u.agent_id', session('agent_id'))
                                    ->whereDate('b.processed_at', DB::raw('CURDATE()'))
                                    ->groupBy('b.username')
                                    ->count();

                $pending_deposits = DB::table('info_deposit as d')
                                    ->join('info_users as u', 'd.user_id', 'u.user_id')
                                    ->where('u.agent_id', session('agent_id'))
                                    ->where('d.status', 0)
                                    ->count();
                $pending_withdrawals = DB::table('info_withdrawals as w')
                                    ->join('info_users as u', 'w.user_id', 'u.user_id')
                                    ->where('u.agent_id', session('agent_id'))
                                    ->where('w.status', '0')
                                    ->count();

                $total_deposits['amount'] = DB::table('info_deposit as d')
                                ->join('info_users as u', 'd.user_id', 'u.id')
                                ->where('d.status', 1)
                                ->where('u.agent_id', session('agent_id'))
                                ->sum('request_amount');
                $total_deposits['krw_amount'] = DB::table('info_deposit as d')
                                ->join('info_users as u', 'd.user_id', 'u.id')
                                ->where('d.status', 1)
                                ->where('u.agent_id', session('agent_id'))
                                ->sum('krw_amount');
                $total_deposits['usd_amount'] = DB::table('info_deposit as d')
                                ->join('info_users as u', 'd.user_id', 'u.id')
                                ->where('d.status', 1)
                                ->where('u.agent_id', session('agent_id'))
                                ->sum('usd_amount');
            }
               
            return view('dashboard.index', compact(
                'total_players', 
                'total_agents', 
                'pending_deposits', 
                'pending_withdrawals', 
                'total_bets_today', 
                'total_player_betting', 
                'total_deposits'));               
            // return view('dashboard.index', array(
            //     'balance' => $balance,
            //     'totalBalance' => $total_user_balance,
            //     'user_count' => $dataCounts['user_count'],
            //     'total_today_bets' => $dataCounts['total_today_bets'],
            //     'total_today_betting' => $dataCounts['total_today_betting']
            // ));
        } else {
            return redirect('/');
        }
    }

    public function profitLoss() {
        $bet_perhour = DB::table('info_bets_honorlink as a')
                    ->join('info_bets_honorlink as b', 'b.referer_id', 'a.transaction_id')
                    ->select('a.*', 'b.amount as win_amount', 'b.balance as win_balance', 'b.transaction_type as transaction_type_result')
                    ->whereDate('a.processed_at', DB::raw('CURDATE()'))
                    ->get();

        return $bet_perhour;
    }
}
