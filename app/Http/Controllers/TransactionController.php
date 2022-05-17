<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    protected $api_key;

    public function __construct() {
        $this->api_key = 'Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD';
    }

    public function index() {
        $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
        $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;
        
        return view('transaction.index', array(
            'balance' => $balance,
            'totalBalance' => $total_user_balance,
        ));
    }

    
    public function search($array, $key, $value) {
		$results = array();
	
		if(is_array($array)) {
			if(isset($array[$key]) && $array[$key] == $value) {
				$results[] = $array;
			}
	
			foreach($array as $subarray) {
				$results = array_merge($results, self::search($subarray, $key, $value));
			}
		}
	
		return $results;
	}

    public function transactionList() {
        $start = '2022-05-01 11:18:52';
        $end = '2022-05-16 11:18:52';
        $page = '1';
        $perPage = '1000';
        $withDetails = '0';

        $get_transaction_history = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/transactions', [
            'start'     => $start,
            'end'       => $end,
            'page'      => $page,
            'perPage'   => $perPage,
            'withDetails' => $withDetails
        ]);

        $transaction_list = json_decode((string) $get_transaction_history->getBody(), true);

		$add_balance 		= $this->search($transaction_list, 'type', 'agent.add_balance');
		$collect_ballance 	= $this->search($transaction_list, 'type', 'agent.subtract_balance');
		$users_give 		= $this->search($transaction_list, 'type', 'users.give_money');
		$users_take			= $this->search($transaction_list, 'type', 'users.take_money');

        $transaction = array_merge($add_balance, $collect_ballance, $users_give, $users_take);
        $totalRecords = count($transaction);
        
        $fieldNames = array(
            "id", 
            "username", 
            "transaction_type", 
            "before", 
            "amount", 
            "balance_after", 
            "processed_at",
            "status"
        );

        $data = $this->format_datatable($transaction, $totalRecords, $fieldNames);
        return $data;
    }
}
