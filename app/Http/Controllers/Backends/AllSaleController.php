<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllSaleController extends Controller
{
    public function index(){
        return view('backends.allsale.index');
    }
}
