<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Slider;
use App\Models\Cart;

use Illuminate\Support\Facades\Session;
class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        $carts = auth()->guard('customer')->check() ? Cart::where('customer_id', auth()->guard('customer')->id())->get() : collect();
        $subtotal = $carts->sum('total');
        return view('bookingwebsite.login', compact('carts', 'subtotal'));
    }


    public function showRegistrationForm()
    {
        $carts = auth()->guard('customer')->check() ? Cart::where('customer_id', auth()->guard('customer')->id())->get() : collect();
        $subtotal = $carts->sum('total');
        return view('bookingwebsite.register', compact('carts', 'subtotal'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('front.home');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('front.home');
    }



    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:customers',
            'email' => 'required|string|email|max:255|unique:customers',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the customer record
        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
            'password' => Hash::make($request->password),
        ]);

        // Log the customer in
        Auth::guard('customer')->login($customer);

        // Redirect to the customer dashboard after successful registration
        return redirect()->route('front.home');
    }



}
