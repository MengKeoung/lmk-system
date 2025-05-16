<?php

namespace App\Http\Controllers\Backends;

use Exception;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::paginate(10);
        return view('backends.product.index', compact('products'));
    }
    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($request->id);
            $product->status = $product->status == 1 ? 0 : 1;
            $product->modified_by = auth()->user()->id;

            $product->save();

            DB::commit();

            $output = ['status' => 1, 'msg' => __('Status Updated!')];
        } catch (Exception $e) {
            DB::rollBack();
            $output = ['status' => 0, 'msg' => __('Something went wrong!')];
        }

        return response()->json($output);
    }
    public function create()
    {
        $categories = Category::all();
        $measures = Measure::all();
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product.create', compact('categories', 'measures', 'language', 'default_lang'));
    }
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'category_id' => 'required',
        'measure_id' => 'required',
        'cost' => 'required',
        'unit_price' => 'required',
        'whole_price' => 'required',
        'inventory' => 'required',
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
        // Get latest product_code including soft deleted products
        $latestCode = Product::withTrashed()->orderByDesc('id')->value('product_code');

        if ($latestCode && preg_match('/PROD-(\d+)/', $latestCode, $matches)) {
            $number = intval($matches[1]) + 1;
        } else {
            $number = 1;
        }

        do {
            $newProductCode = str_pad($number, 7, '0', STR_PAD_LEFT);
            $productCode = 'PROD-' . $newProductCode;
            $number++;
        } while (Product::withTrashed()->where('product_code', $productCode)->exists());

        DB::beginTransaction();
        $user = auth()->user();

        $product = new Product();
        $product->name = $request->name[array_search('en', $request->lang)];
        $product->product_code = $productCode;
        $product->category_id = $request->category_id;
        $product->measure_id = $request->measure_id;
        $product->cost = $request->cost;
        $product->unit_price = $request->unit_price;
        $product->whole_price = $request->whole_price;
        $product->inventory = $request->inventory;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount ?? 0;
        $product->status = $request->status;
        $product->low_stock_threshold = $request->low_stock_threshold ?? 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $directory = public_path('upload/products');

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $image->move($directory, $imageName);
            $product->image = $imageName;
        }

        $product->note = $request->note;
        $product->created_by = $user->id;
        $product->save();

        // Store translations
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                $data[] = [
                    'translationable_type' => 'App\Models\Product',
                    'translationable_id' => $product->id,
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
        Log::error('Product creation error: ' . $e->getMessage());
        $output = ['success' => 0, 'msg' => __('Something went wrong!')];
    }

    return redirect()->route('admin.products.index')->with($output);
}

    public function edit($id)
    {
        $categories = Category::all();
        $measures = Measure::all();
        $product = Product::withoutGlobalScopes()->with('translations')->findOrFail($id);
        $language = BusinessSetting::where('type', 'language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';
        $default_lang = json_decode($language, true)[0]['code'];

        return view('backends.product.edit', compact('categories', 'measures', 'product', 'language', 'default_lang'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'measure_id' => 'required',
            'cost' => 'required',
            'unit_price' => 'required',
            'whole_price' => 'required',
            'inventory' => 'required',
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
            $product = Product::findOrFail($id);
            $product->name = $request->name[array_search('en', $request->lang)];
            $product->category_id = $request->category_id;
            $product->measure_id = $request->measure_id;
            $product->cost = $request->cost;
            $product->unit_price = $request->unit_price;
            $product->whole_price = $request->whole_price;
            $product->inventory = $request->inventory;
            $product->discount_type = $request->discount_type;
            $product->discount = $request->discount ?? 0;
            $product->status = $request->status;
            $product->low_stock_threshold = $request->low_stock_threshold ?? 0;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $directory = public_path('upload/products');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0777, true);
                }

                // Move the image and update the product
                $image->move($directory, $imageName);
                $product->image = $imageName;
            }

            $product->note = $request->note;
            $product->modified_by = $user->id;
            $product->save();

             foreach ($request->lang as $index => $key) {
                if ($request->name[$index] && $key != 'en') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Product',
                            'translationable_id' => $product->id,
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
            Log::error('Product update error: ' . $e->getMessage());
            $output = ['success' => 0, 'msg' => __('Something went wrong!')];
        }    
        return redirect()->route('admin.products.index')->with($output);
    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $product->deleted_by = auth()->user()->id;
            $product->save();
            $product->delete();
            $products = Product::latest('id')->paginate(10);
            $view = view('backends.product.table', compact('products'))->render();

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
