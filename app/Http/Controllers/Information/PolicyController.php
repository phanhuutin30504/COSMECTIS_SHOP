<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function returnPolicy(){
        return view('information.returnPolicy');
    }
    public function paymentPolicy(){
        return view('information.paymentPolicy');
    }
    public function deliveryPolicy(){
        return view('information.deliveryPolicy');
    }
}
