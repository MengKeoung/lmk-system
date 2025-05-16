<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Customer;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {

        $customers = Customer::paginate(10);
        return view('backends.customer.index', compact('customers'));
    }
    public function create()
    {
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.customer.create', compact('language', 'default_lang'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        $enIndex = array_search('en', $request->lang ?? []);

        if ($enIndex === false || empty($request->name[$enIndex])) {
            $validator->after(function ($validator) {
                $validator->errors()->add('name', 'Name field is required!');
            });
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            // Include soft deleted if your model uses SoftDeletes
            $latestCode = Customer::withTrashed()->orderByDesc('id')->value('customer_code');

            if ($latestCode && preg_match('/CUS-(\d+)/', $latestCode, $matches)) {
                $number = intval($matches[1]) + 1;
            } else {
                $number = 1;
            }

            do {
                $newcustomerCode = str_pad($number, 7, '0', STR_PAD_LEFT);
                $customerCode = 'CUS-' . $newcustomerCode;
                $number++;
            } while (Customer::withTrashed()->where('customer_code', $customerCode)->exists());

            DB::beginTransaction();
            $user = auth()->user();
            $customer = new Customer();
            $customer->name = $request->name[$enIndex];
            $customer->customer_code = $customerCode;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $directory = public_path('upload/customers');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                $image->move($directory, $imageName);
                $customer->image = $imageName;
            }

            $customer->note = $request->note;
            $customer->created_by = $user->id;
            $customer->save();

            $data = [];
            foreach ($request->lang as $index => $key) {
                if (!empty($request->name[$index]) && $key != 'en') {
                    $data[] = [
                        'translationable_type' => 'App\Models\Customer',
                        'translationable_id' => $customer->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ];
                }
            }

            if (count($data)) {
                Translation::insert($data);
            }

            DB::commit();

            $output = ['success' => 1, 'msg' => __('Created Successfully!')];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Customer creation error: ' . $e->getMessage());
            $output = ['success' => 0, 'msg' => __('Something went wrong!')];
        }

        return redirect()->route('admin.customers.index')->with($output);
    }
    public function edit($id)
    {
        $customer = Customer::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.customer.edit', compact('language', 'default_lang', 'customer'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if (is_null($request->name[array_search('en', $request->lang)])) {
            $validator->after(function ($validator) {
                $validator->errors()->add('name', 'Name field is required!');
            });
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with(['success' => 0, 'msg' => __('Invalid form input')]);
        }

        try {
            DB::beginTransaction();
            $user = auth()->user();
            $customer = Customer::findOrFail($id);
            $customer->name = $request->name[array_search('en', $request->lang)];
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $directory = public_path('upload/customers');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                // Move the image and update the product
                $image->move($directory, $imageName);
                $customer->image = $imageName;
            }

            $customer->note = $request->note;
            $customer->modified_by = $user->id;
            $customer->save();

            foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Customer',
                            'translationable_id' => $customer->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $request->name[$index]]
                    );
                }
            }

            DB::commit();
            $output = ['success' => 1, 'msg' => __('Updated Successfully!')];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product creation error: ' . $e->getMessage());
            $output = ['success' => 0, 'msg' => __('Something went wrong!')];
        }

        return redirect()->route('admin.customers.index')->with($output);
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::findOrFail($id);
            $customer->deleted_by = auth()->user()->id;
            $customer->save();
            $customer->delete();
            $customers = Customer::latest('id')->paginate(10);
            $view = view('backends.customer.table', compact('customers'))->render();

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
