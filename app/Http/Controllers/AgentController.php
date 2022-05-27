<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index(Request $request) {
        if($request->session()->has('username')) {
            // $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            // $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
            return view('agent.list', array(
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
            "affiliated_agent"
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
        $agent          = $_POST['agent'] != '0'  ? $_POST['agent']   : "";
        $username       = $_POST['agent_username'];
        $nick           = $_POST['agent_nick'];
        $pw             = isset($_POST['agent_pw'])         ? $_POST['agent_pw']            : "";
        $rate           = isset($_POST['rate'])             ? $_POST['rate']                : "";
        $commission     = isset($_POST['commission'])       ? $_POST['commission']          : "";
        $memo           = isset($_POST['memo'])             ? $_POST['memo']                : "";
        $affiliated_agent           = isset($_POST['affiliated_agent'])             ? $_POST['affiliated_agent']                : "";

        if($agent != '0') {
            // DB::table('info_agent')
            // ->where('id', $agent)
            // ->update([
            //     'sub_agent_count' => DB::raw('sub_agent_count + 1')
            // ]);
            DB::table('info_agent')
            ->where('id', $agent)
            ->increment('sub_agent_count', 1);
        }

        $save_agent = DB::table('info_agent')->insert([
            'parent'            => $agent,
            'affiliated_agent' => $affiliated_agent,
            'agent_uname'       => $username,
            'agent_nick'        => $nick,
            'agent_pw'          => md5($pw),
            'rate'              => (int) $rate,
            'commission'        => (int) $commission,
            'balance'           => '0',
            'memo'              => $memo,
            'creation_date'     => date("Y-m-d h:i:s"),
            'status'            => '1',
            'sub_agent_count'   => 0
        ]);

        $admin = DB::table('info_admin')->insert([
            'agent_id'      => $agent,
            'username'      => $username,
            'name'          => $nick,
            'password'      => md5($pw),
            'user_type' => '2',
            'status'    => '1',
        ]);
        
        if($save_agent) {
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
        $agent_id = isset($_GET['nodeId']) ? $_GET['nodeId'] : "";

        if(session('agent_id') == '2838' && session('user_type') == 1) {
            $agent = DB::table('info_agent')
            // ->where('parent', $agent_id)
            ->get();
        } else {
            $agent = DB::table('info_agent')
            ->where('parent', session('agent_id'))
            ->get();
        }

        $folders_arr = [
            array(
                "id" => 0,
                "parent" => '#',
                "text" => 'Winslots', 
                "icon" => 'fa fa-folder-open text-success',
                'li_attr' => array(
                    'pid' => '0',
                    'pname' => 'greatgame'
                ),
                "state" => array(
                    // "selected" => $selected,
                    "opened"=> 1
                ),
                // "children" => $child
            )
        ];
        foreach($agent as $row) {
            $subFolder = $row->parent;
            if($subFolder == '') $subFolder = '0';

            $folders_arr[] = array(
                "id" => $row->id,
                "parent" => $subFolder,
                "text" => $row->agent_uname, 
                "icon" => 'fa fa-user-circle text-primary',
                'li_attr' => array(
                    'pid' => $row->id,
                    'pname' => $row->agent_uname
                ),
                "state" => array(
                    // "selected" => $selected,
                    // "opened"=>$opened
                ),
                // "children" => $child
            );
        }
        
        return json_encode($folders_arr);
    }
}
