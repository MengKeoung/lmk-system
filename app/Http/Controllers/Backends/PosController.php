<?php

namespace App\Http\Controllers\Backends;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\PaymentType;
use App\Models\SalePayment;
use App\Models\SaleProduct;
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $categories = Category::all();
        $paymenttypes = PaymentType::all();
        $exchangeRate = ExchangeRate::where('base_currency', 'USD')->where('target_currency', 'KHR')->first()->rate ?? 1;

        return view('backends.pos.create.index', compact('customers', 'categories', 'paymenttypes', 'exchangeRate'));
    }
    public function searchProduct(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $products = Product::where('name', 'like', '%' . $searchQuery . '%')
            ->get(['id', 'name', 'unit_price', 'discount', 'inventory']);

        return response()->json($products);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'total_quantity' => 'required|integer|min:1',
            'sub_total'     => 'required|numeric|min:0',
            'grand_total'   => 'required|numeric|min:0',
            'products'      => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.inventory' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'payments'      => 'nullable|array',
            'payments.*.payment_type_id' => 'required|exists:paymenttypes,id',
            'payments.*.amount' => 'required|numeric|min:0.01',
        ]);

        $userId = auth()->user()->id;

        foreach ($validatedData['products'] as $product) {
            $dbProduct = Product::findOrFail($product['id']);

            if ($dbProduct->inventory < $product['inventory']) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Insufficient stock for product: ' . $dbProduct->name . '. Only ' . $dbProduct->inventory . ' in stock.'
                ], 400);
            }
        }

        DB::beginTransaction();

        try {
            $lastSale = Sale::latest()->first();
            $newInvoiceNumber = $lastSale ? str_pad(intval(substr($lastSale->sale_code, 4)) + 1, 7, '0', STR_PAD_LEFT) : '0000001';
            $invoiceNo = 'INV-' . $newInvoiceNumber;

            $totalPaid = 0;
            if (!empty($validatedData['payments'])) {
                foreach ($validatedData['payments'] as $payment) {
                    $totalPaid += $payment['amount'];
                }
            }

            if ($totalPaid == 0) {
                $statusId = 'unpaid';
            } elseif ($totalPaid >= $validatedData['sub_total'] - ($request->discount ?? 0)) {
                $statusId = 'paid';
            } elseif ($totalPaid < $validatedData['grand_total']) {
                $statusId = 'partially';
            }

            $sale = Sale::create([
                'sale_code' => $invoiceNo,
                'customer_id' => $validatedData['customer_id'],
                'shift_id' => 1,
                'total_quantity' => $validatedData['total_quantity'],
                'sale_discount' => $request->discount ?? 0,
                'sub_total' => $validatedData['sub_total'],
                'grand_total' => $validatedData['sub_total'] - ($request->discount ?? 0),
                'status' => $statusId,
                'created_by' => $userId,
            ]);

            foreach ($validatedData['products'] as $product) {
                $dbProduct = Product::findOrFail($product['id']);

                $dbProduct->decrement('inventory', $product['inventory']);

                if ($dbProduct->discount_type === 'fixed') {
                    $discountAmountPerUnit = $dbProduct->discount;
                } elseif ($dbProduct->discount_type === 'percentage') {
                    $discountAmountPerUnit = ($dbProduct->discount * $dbProduct->unit_price) / 100;
                } else {
                    $discountAmountPerUnit = 0;
                }

                $totalDiscountAmount = $discountAmountPerUnit * $product['inventory'];
                $totalPrice = $product['inventory'] * $dbProduct->unit_price;
                $totalAmount = $totalPrice - $totalDiscountAmount;

                SaleProduct::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['inventory'],
                    'price' => $dbProduct->unit_price,
                    'discount_type' => $dbProduct->discount_type,
                    'discount' => $dbProduct->discount,
                    'discount_amount' => $totalDiscountAmount,
                    'total' => $totalPrice,
                    'total_amount' => $totalAmount,
                    'created_by' => $userId,
                ]);
            }

            if (!empty($validatedData['payments'])) {
                foreach ($validatedData['payments'] as $payment) {
                    SalePayment::create([
                        'sale_id' => $sale->id,
                        'payment_type_id' => $payment['payment_type_id'],
                        'total_amount' => $validatedData['sub_total'] - ($request->discount ?? 0),
                        'total_paid' => $payment['amount'],
                        'balance' => $validatedData['sub_total'] - ($request->discount ?? 0) - $totalPaid,
                        'created_by' => $userId,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => 1,
                'msg' => __('Created Successfully!'),
                'sale' => $sale
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product creation error: ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'msg' => __('Something went wrong!'),
                'error' => $e->getMessage()
            ]);
        }
    }
}
