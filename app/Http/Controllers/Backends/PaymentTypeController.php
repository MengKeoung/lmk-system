<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentTypeController extends Controller
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

            $paymenttype = new PaymentType();
            $paymenttype->name = $request->name;
            $paymenttype->note = $request->note;
            $paymenttype->created_by = $user->id;
            $paymenttype->save();
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

            $paymenttype = PaymentType::findOrFail($id);
            $paymenttype->name = $request->name;
            $paymenttype->note = $request->note;
            $paymenttype->modified_by = $user->id;
            $paymenttype->save();

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
            $paymenttype = PaymentType::findOrFail($id);
            $paymenttype->deleted_by = auth()->user()->id;
            $paymenttype->save();
            $paymenttype->delete();
            $paymenttypes = PaymentType::latest('id')->paginate(10);
            $view = view('backends.setting.paymenttype.table', compact('paymenttypes'))->render();

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
