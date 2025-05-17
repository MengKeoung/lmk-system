<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExchangeRateController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'base_currency' => 'required',
            'target_currency' => 'required',
            'rate' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        try {
            DB::beginTransaction();

            $exchangerate = new ExchangeRate();
            $exchangerate->base_currency = $request->base_currency;
            $exchangerate->target_currency = $request->target_currency;
            $exchangerate->rate = $request->rate;
            $exchangerate->rate_date = $request->rate_date;
            $exchangerate->save();
            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Created Successfully!')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong!')
            ];
        }
         return redirect()->route('admin.setting.index')->with($output);
    }
    
}
