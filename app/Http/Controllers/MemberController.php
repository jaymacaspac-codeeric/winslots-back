<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index() {
        $hash = md5( "29b25cec12185642c4b2ab6900ffd95c" . "|" . "opkey=29b25cec12185642c4b2ab6900ffd95c&userid=user001&nick=user001" );    
    }

    public function memberCreate() {

    }

    public function memberConfirmation() {
        $get_user = $_GET['userid'];

        $user = DB::table('info_users')
                ->where('username', $get_user)
                ->first();

        $balance = 0;    

        if ($get_user) {
            if($user) {
                $result = 1;
                $balance = $user->balance;
            } else {
                $result = 10;
                $balance = 0; 
            }

            return response()->json(
                [
                    'result' => $result,
                    'balance' => $balance
                ]
            );
        } else {
            return response()->json(
                [
                    'result' => 99,
                    'balance' => 0
                ]
            );
        }
    }

    public function balanceCheck() {
        $get_user = $_GET['username'];

        $user = DB::table('info_users')
                ->where('username', $get_user)
                ->first();

        $balance = 0;    

        if ($get_user) {
            if($user) {
                $result = 1;
                $balance = $user->balance;
            } else {
                $result = 10;
                $balance = 0; 
            }

            return response()->json(
                [
                    'result' => $result,
                    'balance' => (int) $balance
                ]
            );
        } else {
            return response()->json(
                [
                    'result' => 99,
                    'balance' => 0
                ]
            );
        }
    }
}
