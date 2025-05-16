<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Measure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MeasureController extends Controller
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

            $measure = new Measure();
            $measure->name = $request->name;
            $measure->note = $request->note;
            $measure->created_by = $user->id;
            $measure->save();
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

            $measure = Measure::findOrFail($id);
            $measure->name = $request->name;
            $measure->note = $request->note;
            $measure->modified_by = $user->id;
            $measure->save();

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
            $measure = Measure::findOrFail($id);
            $measure->deleted_by = auth()->user()->id;
            $measure->save();
            $measure->delete();
            $measures = Measure::latest('id')->paginate(10);
            $view = view('backends.setting.measure.table', compact('measures'))->render();

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
