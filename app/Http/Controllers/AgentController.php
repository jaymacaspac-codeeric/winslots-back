<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AgentController extends Controller
{
    public function index(Request $request) {
        if($request->session()->has('username')) {
            // $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            // $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
            
            if(session('agent_id') == '2838' && session('admin_type') == 1) {
                $agent = DB::table('info_agent')
                        // ->where('parent', $agent_id)
                        ->where('status', '1')
                        ->get();
            } else {
                $agent = DB::table('info_agent')
                        ->where('affiliated_agent', session('agent_id'))
                        ->where('status', '1')
                        // ->orWhere('agent_id', session('agent_id'))
                        ->get();
            }

            return view('agent.list', array(
                'agents' => $agent
                // 'balance' => $balance,
                // 'totalBalance' => $total_user_balance,
            ));
        } else {
            return redirect('/');
        }
    }

    public function agentList() {
        $agent = DB::table('info_agent')
                // ->where('parent', $agent_id)
                ->get();

        $totalRecords = count($agent);
        $fieldNames = array(
            "id", 
            "agent_uname",
            "agent_nick",
            "rate",
            "commission",
            "balance",
            "parent",
            "affiliated_agent",
            "creation_date"
        );

        $resultArray = json_decode(json_encode($agent), true);

        $data = $this->format_datatable1($resultArray, $totalRecords, $fieldNames);

        return $data;
    }

    public function createAgent(Request $request) {
        if($request->session()->has('username')) {
            // $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            // $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
    
            return view('agent.create', array(
                // 'balance' => $balance,
                // 'totalBalance' => $total_user_balance,
            ));
        } else {
            return redirect('/');
        }
    }

    public function saveAgent() {
        $agent              = $_POST['agent'] != '0'                ? $_POST['agent']               : "";
        $username           = isset($_POST['agent_username'])       ? $_POST['agent_username']      : "";
        $nick               = isset($_POST['agent_nick'])           ? $_POST['agent_nick']          : "";
        $pw                 = isset($_POST['agent_pw'])             ? $_POST['agent_pw']            : "";
        $rate               = isset($_POST['rate'])                 ? $_POST['rate']                : "";
        $commission         = isset($_POST['commission'])           ? $_POST['commission']          : "";
        $memo               = isset($_POST['memo'])                 ? $_POST['memo']                : "";
        $affiliated_agent   = isset($_POST['affiliated_agent'])     ? $_POST['affiliated_agent']    : "";
        $level              = isset($_POST['level'])                ? $_POST['level']               : 0;

        if($agent != '0') {
            DB::table('info_agent')
                ->where('id', $agent)
                ->increment('sub_agent_count', 1);
        }

        $uuid = (string) Str::uuid();

        $save_agent = DB::table('info_agent')->insert([
            'agent_id'          => $uuid,
            'parent'            => $agent,
            'affiliated_agent'  => $affiliated_agent,
            'agent_uname'       => $username,
            'agent_nick'        => $nick,
            'agent_pw'          => md5($pw),
            'rate'              => (int) $rate,
            'commission'        => (int) $commission,
            'balance'           => '0',
            'memo'              => $memo,
            'level'             => $level + 1,
            'creation_date'     => date("Y-m-d\TH:i:s\Z", strtotime(Carbon::now())),
            'status'            => '1',
            'sub_agent_count'   => 0
        ]);

        $admin = DB::table('info_admin')->insert([
            'agent_id'      => $uuid,
            'username'      => $username,
            'name'          => $nick,
            'password'      => md5($pw),
            'level'         => $level + 1,
            'admin_type'     => 2,
            'status'        => '1'
        ]);
        
        if($save_agent && $admin) {
            return 'success';
        }
    }

    public function checkAgentDuplicate() {
        $agent_id = $_POST['id'];

        $agent = DB::table('info_agent')
                ->where('agent_uname', $agent_id)
                ->count();

        if($agent > 0) {
            return 'duplicate';
        } else {
            return 'valid';
        }
    }

    public function populateAgentTree() {
        if(session('agent_id') == '2838' && session('admin_type') == 1) {
            $agent = DB::table('info_agent')
                    // ->where('parent', $agent_id)
                    ->get();

            $folders_arr = [
                array(
                    "id"        => 0,
                    "parent"    => '#',
                    "text"      => 'Winslots', 
                    "icon"      => 'fa fa-folder-open-o text-success',
                    'li_attr'   => array(
                        'pid'       => '0',
                        'pname'     => 'greatgame',
                        'lvl'       => '0',
                        'parent'    => ''
                    ),
                    "state" => array(
                        // "selected" => $selected,
                        "opened" => 1
                    )
                )
            ];
        } else {
            $agent = DB::table('info_agent')
                    ->where('affiliated_agent', session('agent_id'))
                    ->get();

            $folders_arr = [
                array(
                    "id"        => session('agent_id'),
                    "parent"    => '#',
                    "text"      => session('username'), 
                    "icon"      => 'fa fa-users text-primary text-success',
                    'li_attr'   => array(
                        'pid'       => session('agent_id'),
                        'pname'     => session('username'),
                        'lvl'       => session('level'),
                        'parent'    => session('agent_id')
                    ),
                    "state" => array(
                        "selected"  => 1,
                        "opened"    => 1
                    )
                )
            ];
        }

        foreach($agent as $row) {
            $subFolder = $row->parent;
            if($subFolder == '') $subFolder = '0';

            $folders_arr[] = array(
                "id"        => $row->agent_id,
                "parent"    => $subFolder,
                "text"      => $row->agent_uname, 
                "icon"      => 'fa fa-user-o text-primary',
                'li_attr'   => array(
                    'pid'       => $row->agent_id,
                    'pname'     => $row->agent_uname,
                    'lvl'       => $row->level,
                    'parent'    => $row->affiliated_agent
                ),
                "state" => array(
                    // "selected" => $selected,
                    "opened" => 1
                )
            );
        }
        
        return json_encode($folders_arr);
    }

    public function agentInfo($username) {
        return view('agent.info');
    }
}
