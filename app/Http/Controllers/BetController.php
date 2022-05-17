<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BetController extends Controller
{
    public function index() {

    }

    public function bet() {
        // $userid             = $_GET['userid'];
        // $third_party_code   = $_GET['third_party_code'];
        // $third_party_name   = $_GET['third_party_name'];
        // $game_code          = $_GET['game_code'];
        // $amount             = $_GET['amount'];
        // $round_id           = $_GET['round_id'];
        // $trans_id           = $_GET['trans_id'];
        // $date               = $_GET['date'];
        // $game_type          = $_GET['game_type'];
        $hash = md5( "29b25cec12185642c4b2ab6900ffd95c" . "|" . "opkey=29b25cec12185642c4b2ab6900ffd95c&userid=user001&nick=user001" );    
        
        $balance = 500 + (-100);

        return response()->json(
            [
                'result' => 1,
                'balance' => (int) $balance
            ]
        );
    }

    public function betResult() {
        // $userid             = $_GET['userid'];
        // $third_party_code   = $_GET['third_party_code'];
        // $third_party_name   = $_GET['third_party_name'];
        // $game_code          = $_GET['game_code'];
        // $amount             = $_GET['amount'];
        // $round_id           = $_GET['round_id'];
        // $trans_id           = $_GET['trans_id'];
        // $date               = $_GET['date'];
        // $game_type          = $_GET['game_type'];
    }

    public function betRefund() {
        // $userid             = $_GET['userid'];
        // $third_party_code   = $_GET['third_party_code'];
        // $third_party_name   = $_GET['third_party_name'];
        // $game_code          = $_GET['game_code'];
        // $amount             = $_GET['amount'];
        // $round_id           = $_GET['round_id'];
        // $trans_id           = $_GET['trans_id'];
        // $date               = $_GET['date'];
        // $game_type          = $_GET['game_type'];
    }

}
