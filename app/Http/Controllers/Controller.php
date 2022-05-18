<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Ixudra\Curl\Facades\Curl;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $api_key;
    protected $balance;

    public function __construct() {
        $this->balance = 0;
        $this->api_key = 'Wq6U9iv5WErdYetknhvQ4d2Ke4OB36LKaxeDY5yD';
    }

    public function format_datatable($dataTable,$total,$fieldNames) {
		$cells = "";
		$id = 1;
		foreach($dataTable as $row) {
			$fieldNamesCount=count($fieldNames);

			$cells .= '["';

			for ($i =0 ; $i < $fieldNamesCount; $i++) {
				if($fieldNames[$i] == 'username') {
					$cells .= str_replace('"','\"',$row['user']['username']);
				} else if($fieldNames[$i] == 'user_id') {
					$cells .= str_replace('"','\"',$row['user']['id']);
				} else if($fieldNames[$i] == 'title') {
					$cells .= str_replace('"','\"',$row['details']['game']['title']);
				} else if($fieldNames[$i] == 'vendor') {
					$cells .= str_replace('"','\"',$row['details']['game']['vendor']);
				} else if($fieldNames[$i] == 'game_id') {
					$cells .= str_replace('"','\"',$row['details']['game']['id']);
				} else if($fieldNames[$i] == 'game_type') {
					$cells .= str_replace('"','\"',$row['details']['game']['type']);
				} else if($fieldNames[$i] == 'game_round') {
					$cells .= str_replace('"','\"',$row['details']['game']['round']);
				} else if($fieldNames[$i] == 'transaction_id') {
					$cells .= str_replace('"','\"',$row['external']['id']);
				} else if($fieldNames[$i] == 'bet_description') {
					if(is_null($row['external']['detail'])) {
						$cells .= str_replace('"','\"',$row['external']['detail']);
					} else {
						$cells .= str_replace('"','\"',$row['external']['detail']['data']['participants'][0]['bets'][0]['description']);
					}
				} else if($fieldNames[$i] == 'bet_stake') {
					if($row['details']['game']['type'] == 'slot') {

					} else if($row['details']['game']['type'] == 'baccarat' || $row['details']['game']['type'] == 'dragontiger') {
						if(is_null($row['external']['detail'])) {
							$cells .= str_replace('"','\"',$row['external']['detail']);
						} else {
							$cells .= str_replace('"','\"',$row['external']['detail']['data']['participants'][0]['bets'][0]['stake']);
						}
					}
				} else if($fieldNames[$i] == 'bet_payout') {
					if(is_null($row['external']['detail'])) {
						$cells .= str_replace('"','\"',$row['external']['detail']);
					} else {
						$cells .= str_replace('"','\"',$row['external']['detail']['data']['participants'][0]['bets'][0]['payout']);
					}
				} else if($fieldNames[$i] == 'balance_after') {
					if($row['amount'] > 0) {
						$total = $row['amount'] + $row['before'];
					} else {
						$total = $row['before'] - abs($row['amount']);
					}
					$cells .= str_replace('"','\"',$total);
				} else if($fieldNames[$i] == 'transaction_type') {
					if($row['type'] == 'users.take_money' || $row['type'] == 'agent.subtract_balance') {
						$type = 'User money recovery';
					} else if($row['type'] == 'users.give_money' || $row['type'] == 'agent.add_balance') {
						$type = 'User money recharge';
					}
					$cells .= str_replace('"','\"',$type);
				} else {
					$cells .= str_replace('"','\"',$row[$fieldNames[$i]]);
				}

				if ($i != $fieldNamesCount - 1)
					$cells .=  '","';
			}

			$cells .= '"],';
			$id ++;
		}

			$cells = rtrim($cells,",");
			$json_data = '{' .

				'"sEcho": 1,' .

				'"iTotalRecords": ' . $total . ',' .

				'"iTotalDisplayRecords": '.$total.',' .

				'"aaData" : ['.

				$cells. ']' .

				'}';

		return $json_data ;
	}

	public function format_datatable1($dataTable,$total,$fieldNames) {
		$cells = "";
		$id = 1;
		foreach($dataTable as $row) {
			$fieldNamesCount=count($fieldNames);

			$cells .= '["';

			for ($i =0 ; $i < $fieldNamesCount; $i++) {
				if($fieldNames[$i] == 'balance') {
					$cells .= str_replace('"','\"', number_format($row['balance'], 0));
				} else {
					$cells .= str_replace('"','\"',$row[$fieldNames[$i]]);
				}

				if ($i != $fieldNamesCount - 1)
					$cells .=  '","';
			}

			$cells .= '"],';
			$id ++;
		}

			$cells = rtrim($cells,",");
			$json_data = '{' .

				'"sEcho": 1,' .

				'"iTotalRecords": ' . $total . ',' .

				'"iTotalDisplayRecords": '.$total.',' .

				'"aaData" : ['.

				$cells. ']' .

				'}';

		return $json_data ;
	}

    public function format_datatable2($dataTable,$total,$fieldNames) {
		$cells = "";
		$id = 1;
		foreach($dataTable as $row) {
			$fieldNamesCount=count($fieldNames);

			$cells .= '["';

			for ($i =0 ; $i < $fieldNamesCount; $i++) {
				if($fieldNames[$i] == 'username') {
					$cells .= str_replace('"','\"',$row[0]['user']['username']);
				} else if($fieldNames[$i] == 'user_id') {
					$cells .= str_replace('"','\"',$row[0]['user']['id']);
				} else if($fieldNames[$i] == 'title') {
					$cells .= str_replace('"','\"',$row[0]['details']['game']['title']);
				} else if($fieldNames[$i] == 'vendor') {
					$cells .= str_replace('"','\"',$row[0]['details']['game']['vendor']);
				} else if($fieldNames[$i] == 'game_id') {
					$cells .= str_replace('"','\"',$row[0]['details']['game']['id']);
				} else if($fieldNames[$i] == 'game_type') {
					$cells .= str_replace('"','\"',$row[0]['details']['game']['type']);
				} else if($fieldNames[$i] == 'game_round') {
					$cells .= str_replace('"','\"',$row[0]['details']['game']['round']);
				} else if($fieldNames[$i] == 'transaction_id') {
					$cells .= str_replace('"','\"',$row[0]['id']);
				} else if($fieldNames[$i] == 'created_at') {
                    $cells .= str_replace('"','\"',$row[0]['processed_at']);
                } else if($fieldNames[$i] == 'processed_at') {
                    $cells .= str_replace('"','\"',$row[1]['processed_at']);
                } else if($fieldNames[$i] == 'bet_description') {
					// if(is_null($row['external']['detail'])) {
					// 	$cells .= str_replace('"','\"',$row[0]['external']['detail']);
					// } else {
					// 	$cells .= str_replace('"','\"',$row[0]['external']['detail']['data']['participants'][0]['bets'][0]['description']);
					// }
				} else if($fieldNames[$i] == 'bet_stake') {
                    $cells .= str_replace('"','\"',abs($row[0]['amount']));
					// if($row[0]['details']['game']['type'] == 'slot') {

					// } else if($row[0]['details']['game']['type'] == 'baccarat' || $row[0]['details']['game']['type'] == 'dragontiger') {
					// 	if(is_null($row[0]['external']['detail'])) {
					// 		$cells .= str_replace('"','\"',$row[0]['external']['detail']);
					// 	} else {
					// 		$cells .= str_replace('"','\"',$row[0]['external']['detail']['data']['participants'][0]['bets'][0]['stake']);
					// 	}
					// }
				} else if($fieldNames[$i] == 'bet_payout') {
                    $cells .= str_replace('"','\"',$row[1]['amount']);
					// if(is_null($row[0]['external']['detail'])) {
					// 	$cells .= str_replace('"','\"',$row[0]['external']['detail']);
					// } else {
					// 	$cells .= str_replace('"','\"',$row[0]['external']['detail']['data']['participants'][0]['bets'][0]['payout']);
					// }
				} else if($fieldNames[$i] == 'balance_after') {
					if($row['amount'] > 0) {
						$total = $row[0]['amount'] + $row[0]['before'];
					} else {
						$total = $row[0]['before'] - abs($row[0]['amount']);
					}
					$cells .= str_replace('"','\"',$total);
				} else if($fieldNames[$i] == 'transaction_type') {
					if($row[0]['type'] == 'users.take_money' || $row[0]['type'] == 'agent.subtract_balance') {
						$type = 'User money recovery';
					} else if($row[0]['type'] == 'users.give_money' || $row[0]['type'] == 'agent.add_balance') {
						$type = 'User money recharge';
					}
					$cells .= str_replace('"','\"',$type);
				} else {
					$cells .= str_replace('"','\"',$row[0][$fieldNames[$i]]);
				}

				if ($i != $fieldNamesCount - 1)
					$cells .=  '","';
			}

			$cells .= '"],';
			$id ++;
		}

			$cells = rtrim($cells,",");
			$json_data = '{' .

				'"sEcho": 1,' .

				'"iTotalRecords": ' . $total . ',' .

				'"iTotalDisplayRecords": '.$total.',' .

				'"aaData" : ['.

				$cells. ']' .

				'}';

		return $json_data ;
	}

    public function getAgentInfo() {
        // $info = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/my-info');
        // $info = Http::withHeaders([
		// 	'Authorization' => 'Bearer ' . $this->api_key,
		// 	'Accept' => 'application/json',
		// 	'Content-Type' => 'application/json'
		// ])->get('https://api.honorlink.org/api/my-info');

		$response = Curl::to('https://api.honorlink.org/api/my-info')
        ->withHeader('Authorization: Bearer '. $this->api_key)
		// ->asJson()
        ->get();

		return json_decode($response, true);
    
		// if($info->serverError()) {
		// 	return 'Server Error';
		// } else {
		// 	return $info;
		// }
    }

    public function getTotalUserBalance() {
        // $user = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/user-list');
		
        // $user = Http::withHeaders([
		// 	'Authorization' => 'Bearer ' . $this->api_key,
		// 	'Accept' => 'application/json',
		// 	'Content-Type' => 'application/json'
		// ])->get('https://api.honorlink.org/api/user-list');
    
        // $data = json_decode((string) $user->getBody(), true);
        // $total = 0;
		// if($data) {
		// 	foreach ($data as $item) {
		// 		$total += $item['balance'];
		// 	}
		// }

		$user = Curl::to('https://api.honorlink.org/api/user-list')
        ->withHeader('Authorization: Bearer '. $this->api_key)
        ->get();

		$data = json_decode($user, true);
        $total = 0;
		if($data) {
			foreach ($data as $item) {
				$total += $item['balance'];
			}
		}

		return $total;

		// if($user->serverError()) {
		// 	return 'Server Error';
		// } else {
		// 	return $total;
		// }
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

    public function dataCounts() {
        $date = date('Y-m-d');
		// $date = '2022-05-04';
	
		$params = array(
            'start'           => $date . ' 00:00:00',
            'end'             => $date . ' 23:59:59',
            'page'            => 1,
            'perPage'         => 1000
        ); 

        $user = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/user-list');
        $bet = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/transaction-list-simple', $params);
        
        // $search_by_bet = $this->search(json_decode((string) $bet->getBody(), true), 'type', 'bet');

        // $bet_by_user = [];
		// foreach($search_by_bet as $element) {
		// 	// group by betting log
		// 	$bet_by_user[$element['user']['id']][] = [
		// 		'id' => $element['id']
		// 	];
		// }

		$user = Curl::to('https://api.honorlink.org/api/user-list')
        ->withHeader('Authorization: Bearer '. $this->api_key)
        ->get();

		$bet = Curl::to('https://api.honorlink.org/api/transaction-list-simple')
        ->withHeader('Authorization: Bearer '. $this->api_key)
		->withData( $params )
        ->get();

		$search_by_bet = $this->search($bet, 'type', 'bet');

        $bet_by_user = [];
		foreach($search_by_bet as $element) {
			// group by betting log
			$bet_by_user[$element['user']['id']][] = [
				'id' => $element['id']
			];
		}

        // return array(
        //     'user_count' => !$user->serverError() ? count(json_decode((string) $user->getBody(), true)) : 0,
        //     'total_today_bets' => !$bet->serverError() ? count($search_by_bet) : 0,
        //     'total_today_betting' => !$bet->serverError() ? count($bet_by_user) : 0
        // );
		return array(
            'user_count' => $user ? count(json_decode($user, true)) : 0,
            'total_today_bets' => $bet ? count($search_by_bet) : 0,
            'total_today_betting' => $bet ? count($bet_by_user) : 0
        );
    }

    // USER LIST
    public function userListApi() {
        $user = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/user-list');

        return $user;
    }

    public function userInfo() {
        $info = Http::withToken($this->api_key)->get('https://api.honorlink.org/api/user');

        return $info;
    }
}
