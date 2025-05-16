<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('backends.category.index', compact('categories'));
    }
    public function create()
    {
        return view('backends.category.create');
    }
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

            $category = new Category();
            $category->name = $request->name;
            $category->note = $request->note;
            $category->created_by = $user->id;
            $category->save();
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
        return redirect()->route('admin.categories.index')->with($output);
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backends.category.edit', compact('category'));
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

            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->note = $request->note;
            $category->modified_by = $user->id;
            $category->save();

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

        return redirect()->route('admin.categories.index')->with($output);
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $category->deleted_by = auth()->user()->id;
            $category->save();
            $category->delete();
            $categories = Category::latest('id')->paginate(10);
            $view = view('backends.category.table', compact('categories'))->render();

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
