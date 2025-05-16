<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->paginate(10);
        return view('backends.expense.index', compact('expenses'));
    }
    public function create()
    {
        return view('backends.expense.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        try {
            DB::beginTransaction();

            $expense = new Expense();
            $expense->name = $request->name;
            $expense->amount = $request->amount;
            $expense->date = $request->date;
            $expense->note = $request->note;
            $expense->created_by = $user->id;
            $expense->save();
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
        return redirect()->route('admin.expenses.index')->with($output);
    }
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('backends.expense.edit', compact('expense'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        try {
            DB::beginTransaction(); 
            $expense = Expense::findOrFail($id);
            $expense->name = $request->name;
            $expense->amount = $request->amount;
            $expense->date = $request->date;
            $expense->note = $request->note;
            $expense->modified_by = $user->id;
            $expense->save();
            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('Updated Successfully!')
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $output = [
                'success' => 0,
                'msg' => __('Something went wrong!')
            ];
        }
        return redirect()->route('admin.expenses.index')->with($output);
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $expense = Expense::findOrFail($id);
            $expense->deleted_by = auth()->user()->id;
            $expense->save();
            $expense->delete();
            $expenses = Expense::latest('id')->paginate(10);
            $view = view('backends.expense.table', compact('expenses'))->render();

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
