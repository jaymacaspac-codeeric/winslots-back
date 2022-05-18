<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    protected $api_key;

    public function __construct() {
        $this->api_key = 'Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD';
    }

    public function index() {

    }

    public function userList(Request $request) {
        if($request->session()->has('username')) {
            $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
            $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
    
            return view('user.list', array(
                'balance' => $balance,
                'totalBalance' => $total_user_balance,
            ));
        } else {
            return redirect('/');
        }
    }

    public function getUserList() {
        $user = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/user-list');
       
        $totalRecords = count(json_decode((string) $user->getBody(), true));
        $fieldNames = array("id","username","agent_id", "balance", "point", "created_at", "last_access_at", "username", "nickname");
        $data = $this->format_datatable1(json_decode((string) $user->getBody(), true), $totalRecords, $fieldNames);
    
        return $data;
    }

    public function searchUser($array, $key, $value) {
		$results = array();
	
		if(is_array($array)) {
			if (isset($array['user'][$key]) && $array['user'][$key] == $value) {
				$results[] = $array;
			}
	
			foreach ($array as $subarray) {
				$results = array_merge($results, self::searchUser($subarray, $key, $value));
			}
		}
	
		return $results;
	}

    public function getUserInfo($username) {
        $user = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/user', [
            'username' => $username
        ]);

        $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
        $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
		
        return view('user.info', array(
            'balance' => $balance,
            'totalBalance' => $total_user_balance,
            'user_info' => $user
        ));
    }

    public function userBetHistory() {
        $start = '2022-05-08 11:18:52';
        $end = '2022-05-16 11:18:52';
        $page = '1';
        $perPage = '1000';
        $start_transaction_id = '';
        $order = '';

        $user = $_GET['username'];

        $get_bet_history = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/transaction-list-simple', [
            'start'     => $start,
            'end'       => $end,
            'page'      => $page,
            'perPage'   => $perPage,
            'order'     => $order
        ]);
        $bet_history_data 	= $this->searchUser(json_decode((string) $get_bet_history->getBody(), true), 'username', $user);
        $bet_history = array_chunk($bet_history_data, 2);
        $totalRecords = count($bet_history);
        $fieldNames = array(
            "id", 
            "username", 
            "title", 
            "amount", 
            // "before", 
            "created_at", 
            "processed_at", 
            "id",
            "user_id", 
            "vendor",
            "game_id",
            "game_type",
            "game_round",
            "transaction_id",
            // "bet_description",
            "bet_stake",
            "bet_payout"
        );

        $data = $this->format_datatable2($bet_history, $totalRecords, $fieldNames);
        return $data;
    }

    // if not using the integrated wallet
    public function userRecharge() {
        $username = '';
        $amount = '';

        $add_balance = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/add-balance', [
            'username'     => $username,
            'amount'       => $amount
        ]);
        
        $data = array(
            'recharge' => $add_balance,
            'info' => $this->getAgentInfo(),
            'totalBalance' => $this->getTotalUserBalance()
        );

        return $data;
    }

    public function userCollect() {
        $username = '';
        $amount = '';

        $collect_balance = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/sub-balance', [
            'username'     => $username,
            'amount'       => $amount
        ]);

        $data = array(
            'recharge' => $collect_balance,
            'info' => $this->getAgentInfo(),
            'totalBalance' => $this->getTotalUserBalance()
        );

        return $data;
    }
}
