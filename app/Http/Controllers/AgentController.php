<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function list(Request $request) {
        if($request->session()->has('username')) {
            $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
    
            return view('agent.list', array(
                'balance' => $balance,
                'totalBalance' => $total_user_balance,
            ));
        } else {
            return redirect('/');
        }
    }

    public function createAgent(Request $request) {
        if($request->session()->has('username')) {
            $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
    
            return view('agent.create', array(
                'balance' => $balance,
                'totalBalance' => $total_user_balance,
            ));
        } else {
            return redirect('/');
        }
    }

    public function saveAgent() {
        $agent          = isset($_POST['agent'])            ? $_POST['agent']               : "2838";
        $username       = $_POST['agent_username'];
        $nick           = $_POST['agent_nick'];
        $pw             = isset($_POST['agent_pw'])         ? $_POST['agent_pw']            : "";
        $rate           = isset($_POST['rate'])             ? $_POST['rate']                : "";
        $commission     = isset($_POST['commission'])       ? $_POST['commission']          : "";
        $memo           = isset($_POST['memo'])             ? $_POST['memo']                : "";

        $agent = DB::table('info_agent')->insert([
            'parent'        => $agent,
            'agent_uname'   => $username,
            'agent_nick'    => $nick,
            'agent_pw'      => md5($pw),
            'rate'          => (int) $rate,
            'commission'    => (int) $commission,
            'balance'       => '0',
            'memo'          => $memo,
            'creation_date'  => date("Y-m-d h:i:s"),
            'status'    => '1'
        ]);
        if($agent) {
            return 'success';
        }
    }

    public function checkAgentDuplicate() {
        $agent_id = $_POST['id'];

        $agent = DB::table('info_agent')->where(
            'agent_uname', $agent_id
            )->count();
        if($agent > 0) {
            return 'duplicate';
        } else {
            return 'valid';
        }
    }

    public function populateAgentTree() {
        $agent = DB::table('info_agent')->get();
    }
}
