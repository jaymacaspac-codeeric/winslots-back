<?php
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

function getIpInfo() {
    $ip = $_SERVER["REMOTE_ADDR"];

    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }


    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);

    $country    = @$xml->geoplugin_countryName;
    $city       = @$xml->geoplugin_city;
    $area       = @$xml->geoplugin_areaCode;
    $code       = @$xml->geoplugin_countryCode;
    $long       = @$xml->geoplugin_longitude;
    $lat        = @$xml->geoplugin_latitude;

    $data['country']    = $country;
    $data['city']       = $city;
    $data['area']       = $area;
    $data['code']       = $code;
    $data['long']       = $long;
    $data['lat']        = $lat;
    $data['ip']         = request()->ip();
    $data['time']       = date('d-m-Y h:i:s A');

    return $data;
}

function osBrowser() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $osPlatform = "Unknown OS Platform";
    $osArray = array(
        '/windows nt 10/i'      => 'Windows 10',
        '/windows nt 6.3/i'     => 'Windows 8.1',
        '/windows nt 6.2/i'     => 'Windows 8',
        '/windows nt 6.1/i'     => 'Windows 7',
        '/windows nt 6.0/i'     => 'Windows Vista',
        '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     => 'Windows XP',
        '/windows xp/i'         => 'Windows XP',
        '/windows nt 5.0/i'     => 'Windows 2000',
        '/windows me/i'         => 'Windows ME',
        '/win98/i'              => 'Windows 98',
        '/win95/i'              => 'Windows 95',
        '/win16/i'              => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i'        => 'Mac OS 9',
        '/linux/i'              => 'Linux',
        '/ubuntu/i'             => 'Ubuntu',
        '/iphone/i'             => 'iPhone',
        '/ipod/i'               => 'iPod',
        '/ipad/i'               => 'iPad',
        '/android/i'            => 'Android',
        '/blackberry/i'         => 'BlackBerry',
        '/webos/i'              => 'Mobile'
    );
    foreach ($osArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $osPlatform = $value;
        }
    }
    $browser = "Unknown Browser";
    $browserArray = array(
        '/msie/i'       => 'Internet Explorer',
        '/firefox/i'    => 'Firefox',
        '/safari/i'     => 'Safari',
        '/chrome/i'     => 'Chrome',
        '/edge/i'       => 'Edge',
        '/opera/i'      => 'Opera',
        '/netscape/i'   => 'Netscape',
        '/maxthon/i'    => 'Maxthon',
        '/konqueror/i'  => 'Konqueror',
        '/mobile/i'     => 'Handheld Browser'
    );
    foreach ($browserArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) {
            $browser = $value;
        }
    }

    $data['os_platform']    = $osPlatform;
    $data['browser']        = $browser;

    return $data;
}

function getAgentRate() {
    $agent = DB::table('info_agent')
            ->where('agent_id', session('agent_id'))
            ->first();

    if(session('agent_id') == '2838' && session('admin_type') == 1) {
        $rate = 0; 
    } else {
        $rate = $agent->rate; 
    }

    return $rate;        
}

function getAdmin() {
    $admin = DB::table('info_admin')
            ->where('id', session('id'))
            ->first();

    return $admin;
}

function getPaymentMethod() {
    $check_method = DB::table('set_agent_payment')
                    ->where('agent_id', '2838')
                    ->count();

    if($check_method > 0) {
        $method = DB::table('set_agent_payment as p')
                    ->join('gateway_currencies as c', 'p.gateway_id', 'c.id')
                    ->where('c.status', 1)
                    ->where('p.agent_id', '2838')
                    ->whereNotNull('p.parameter')
                    ->get();
    } else {
        // $method = DB::table('gateway_currencies')
        //             ->where('status', 1)
        //             ->get();
    }

    return $method;
}

function getImage($image,$size = null) {
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image',$size);
    }
    return asset('assets/images/default.png');
}

function imagePath() {
    $data['gateway'] = [
        'path' => 'assets/images/gateway',
        'size' => '800x800',
    ];
    $data['verify'] = [
        'withdraw'=>[
            'path'=>'assets/images/verify/withdraw'
        ],
        'deposit'=>[
            'path'=>'assets/images/verify/deposit'
        ]
    ];
    $data['image'] = [
        'default' => 'assets/images/default.png',
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'assets/support',
    ];
    $data['language'] = [
        'path' => 'assets/images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'assets/images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['extensions'] = [
        'path' => 'assets/images/extensions',
        'size' => '36x36',
    ];
    $data['seo'] = [
        'path' => 'assets/images/seo',
        'size' => '600x315'
    ];
    $data['profile'] = [
        'user'=> [
            'path'=>'assets/images/user/profile',
            'size'=>'206x206'
        ],
        'admin'=> [
            'path'=>'assets/admin/images/profile',
            'size'=>'400x400'
        ]
    ];
    $data['lottery'] = [
        'path'=>'assets/images/lottery',
        'size'=>'128x123'

    ];
    return $data;
}

function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if ($size) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if ($thumb) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }

    return $filename;
}

function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}

function format_datatable($dataTable,$total,$fieldNames) {
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

?>