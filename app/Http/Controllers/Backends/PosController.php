<?php

namespace App\Http\Controllers\Backends;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $categories = Category::all();
       
        return view('backends.pos.create.index', compact('customers', 'categories'));
    }
    public function searchProduct(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $products = Product::where('product_name', 'like', '%' . $searchQuery . '%')
            ->get(['id', 'name', 'price', 'price_after_discount', 'qty']);

        return response()->json($products);
    }
}
