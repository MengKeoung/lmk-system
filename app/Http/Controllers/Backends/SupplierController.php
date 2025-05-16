<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::paginate(10);
        return view('backends.supplier.index', compact('suppliers'));
    }
    public function create(){
        return view('backends.supplier.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        try {
            DB::beginTransaction();

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $directory = public_path('upload/suppliers');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                // Move the image and update the product
                $image->move($directory, $imageName);
                $supplier->image = $imageName;
            }

            $supplier->note = $request->note;
            $supplier->created_by = $user->id;
            $supplier->save();
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
        return redirect()->route('admin.suppliers.index')->with($output);
    }
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backends.supplier.edit', compact('supplier'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();

        try {
            DB::beginTransaction();

            $supplier = Supplier::findOrFail($id);
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->note = $request->note;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $directory = public_path('upload/suppliers');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                $image->move($directory, $imageName);
                $supplier->image = $imageName;
            }
            $supplier->modified_by = $user->id;
            $supplier->save();

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

        return redirect()->route('admin.suppliers.index')->with($output);
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $supplier = Supplier::findOrFail($id);
            $supplier->deleted_by = auth()->user()->id;
            $supplier->save();
            $supplier->delete();
            $suppliers = Supplier::latest('id')->paginate(10);
            $view = view('backends.supplier.table', compact('suppliers'))->render();

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
