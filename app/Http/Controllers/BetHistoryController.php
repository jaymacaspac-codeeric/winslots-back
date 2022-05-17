<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BetHistoryController extends Controller
{
    public function index() {
        $balance = $this->getAgentInfo() != 'Server Error' ? $this->getAgentInfo()['balance'] : 0 ;
        $total_user_balance = $this->getTotalUserBalance() != 'Server Error' ? $this->getTotalUserBalance() : 0;

       return view('bet-history.index', array(
            'balance' => $balance,
            'totalBalance' => $total_user_balance,
        )); 
    }

    public function betHistoryList() {
        $start = '2022-05-08 11:18:52';
        $end = '2022-05-16 11:18:52';
        $page = '1';
        $perPage = '1000';
        $start_transaction_id = '';
        $order = '';

        $get_bet_history = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/transaction-list-simple', [
            'start'     => $start,
            'end'       => $end,
            'page'      => $page,
            'perPage'   => $perPage,
            'order'     => $order
        ]);

        $bet_history = array_chunk(json_decode((string) $get_bet_history->getBody(), true)['data'], 2);

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

    public function betHistoryDetails() {
        $id = $_GET['id'];

        $get_bet_history_details = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/transaction-detail', [
            'transaction_id'     => $id
        ]);
        
        $data = array(
            'data' => json_decode((string) $get_bet_history_details->getBody(), true),
            'status_code' => $get_bet_history_details->status()
        );

        return $data;
    }
}