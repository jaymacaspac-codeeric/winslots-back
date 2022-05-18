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
            dd($this->getAgentInfo());
            
            $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
            $dataCounts = $this->dataCounts();
    
            return view('dashboard.index', array(
                'balance' => $balance,
                'totalBalance' => $total_user_balance,
                'user_count' => $dataCounts['user_count'],
                'total_today_bets' => $dataCounts['total_today_bets'],
                'total_today_betting' => $dataCounts['total_today_betting']
            ));
        } else {
            return redirect('/');
        }
    }
}
