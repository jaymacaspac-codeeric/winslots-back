<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PaymentGatewayController extends Controller
{
    public function index(Request $request) {
        if($request->session()->has('username')) {
            return view('gateway.index');
        } else {
            return redirect('/');
        }
    }

    public function create(Request $request) {
        if($request->session()->has('username')) {
            return view('gateway.new');
        } else {
            return redirect('/');
        }
    }

    public function save(Request $request) {
        $request->validate([
            'gateway_name'          => 'required|max:60',
            'image'                 => 'required|image|mimes:jpeg,jpg,png',
            'method_rate'           => 'required|numeric|gt:0',
            'method_currency'       => 'required|max:10',
            'min_amount'            => 'required|numeric|gt:0',
            'max_amount'            => 'required|numeric|gt:'.$request->min_amount,
            'instruction'           => 'nullable|max:64000',
            'field_name.*'          => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required',
        ]);

        $path = imagePath()['gateway']['path'];
        $size = imagePath()['gateway']['size'];

        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $inputForm = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = array();
                $arr['field_name'] = strtolower(str_replace(' ', '_', trim($request->field_name[$a])));
                $arr['field_level'] = trim($request->field_name[$a]);
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $inputForm[$arr['field_name']] = $arr;
            }
        }

        $created_date = date("Y-m-d\TH:i:s\Z", strtotime(Carbon::now()));

        $is_crypto = $request->has('is_crypto') ? 1 : 0;

        $method = DB::table('gateway_currencies')->insert([
            'name'          => $request->gateway_name,
            'currency'      => $request->method_currency,
            'rate'          => $request->method_rate,
            'min_amount'    => $request->min_amount,
            'max_amount'    => $request->max_amount,
            'image'         => $filename,
            'crypto'        => $is_crypto,
            'description'   => $request->instruction,
            'input_form'    => json_encode($inputForm),
            'created_at'    => $created_date,
            'status'        => 1
        ]);

        $notify[] = ['success', $request->gateway_name . ' Manual gateway has been added.'];
        return redirect()->route('payment.index')->withNotify($notify);
    }

    public function list() {
        $list = DB::table('gateway_currencies')
                ->get();

        return $list;        
    }

    public function edit($id) {
        $gateway = DB::table('gateway_currencies')
                ->where('id', $id)
                ->first();

        return view('gateway.edit', compact('gateway'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'gateway_name'          => 'required|max:60',
            'image'                 => 'nullable|image|mimes:jpeg,jpg,png',
            'method_rate'           => 'required|numeric|gt:0',
            'method_currency'       => 'required|max:10',
            'min_amount'            => 'required|numeric|gt:0',
            'max_amount'            => 'required|numeric|gt:'.$request->min_amount,
            'instruction'           => 'nullable|max:64000',
            'field_name.*'          => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required',
        ]);

        $path = imagePath()['gateway']['path'];
        $size = imagePath()['gateway']['size'];

        $image = DB::table('gateway_currencies')
                ->where('id', $id)
                ->first();

        $filename = $image->image;
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $image->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $inputForm = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = array();
                $arr['field_name'] = strtolower(str_replace(' ', '_', trim($request->field_name[$a])));
                $arr['field_level'] = trim($request->field_name[$a]);
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $inputForm[$arr['field_name']] = $arr;
            }
        }

        $is_crypto = $request->has('is_crypto') ? 1 : 0;

        DB::table('gateway_currencies')
        ->where('id', $id)
        ->update([
            'name'          => $request->gateway_name,
            'currency'      => $request->method_currency,
            'rate'          => $request->method_rate,
            'min_amount'    => $request->min_amount,
            'max_amount'    => $request->max_amount,
            'image'         => $filename,
            'crypto'        => $is_crypto,
            'description'   => $request->instruction,
            'input_form'    => json_encode($inputForm),
            'updated_at'    => date("Y-m-d\TH:i:s\Z", strtotime(Carbon::now())),
        ]);

        
        $notify[] = ['success', $request->gateway_name . ' Manual gateway has been added.'];
        return redirect()->route('payment.index')->withNotify($notify);
    }

    public function status(Request $request) {
        DB::table('gateway_currencies')
        ->where('id', $request->id)
        ->update([
            'status' => $request->status,
        ]);

        if($request->status == 1) {
            $label = 'activated';
        } else {
            $label = 'deactivated';
        }

        $notify[] = ['success', $request->name . ' has been ' . $label . '.'];
        return redirect()->route('payment.index')->withNotify($notify);
    }

    public function delete(Request $request) {
        $method = DB::table('gateway_currencies')
                ->where('id', $request->id)
                ->first();

        $delete = DB::table('gateway_currencies')
                ->where('id', $request->id)
                ->delete();

        $path = imagePath()['gateway']['path'];
        removeFile($path . '/' . $method->image);

        if($delete) {
            $notify[] = ['success', $request->name . ' has been deleted.'];
            return redirect()->route('payment.index')->withNotify($notify);
        }
    }
}
