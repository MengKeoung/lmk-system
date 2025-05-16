<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        try {
            DB::beginTransaction();

            $currency = new Currency();
            $currency->name = $request->name;
            $currency->symbol = $request->symbol;
            $currency->created_by = $user->id;
            $currency->save();
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        try {
            DB::beginTransaction();

            $currency = Currency::findOrFail($id);
            $currency->name = $request->name;
            $currency->symbol = $request->symbol;
            $currency->modified_by = $user->id;
            $currency->save();

            DB::commit();

            $output = [
                'success' => 1,
                'msg' => __('Updated Successfully!')
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            $output = [
                'success' => 0,
                'msg' => __('Something went wrong!')
            ];
        }

        return redirect()->route('admin.setting.index')->with($output);
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $currency = Currency::findOrFail($id);
            $currency->deleted_by = auth()->user()->id;
            $currency->save();
            $currency->delete();
            $currencies = Currency::latest('id')->paginate(10);
            $view = view('backends.setting.currency.table', compact('currencies'))->render();

            DB::commit();
            $output = [
                'status' => 1,
                'view'  => $view,
                'msg' => __('Deleted Successfully!')
            ];
        } catch (Exception $e) {
            DB::rollBack();

            $output = [
                'status' => 0,
                'msg' => __('Something when wrong!')
            ];
        }
        return response()->json($output);
    }
}
