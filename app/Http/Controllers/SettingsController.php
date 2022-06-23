<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function generalSettings(Request $request) {
        if($request->session()->has('username')) {
            $settings = DB::table('set_site')
                    ->first();

            return view('settings.general', compact('settings'));
        } else {
            return redirect('/');
        }
    }

    public function updateGeneralSettings(Request $request) {
        $settings = DB::table('set_site')
                    ->update([
                        'site_title' => $request->sitename,
                        'currency' => $request->currency,
                        'currency_symbol' => $request->currency_symbol,
                        'conversion_rate' => $request->conversion_rate
                    ]);

        $notify[] = ['success', 'General setting has been updated.'];
        return back()->withNotify($notify);
    }
}
