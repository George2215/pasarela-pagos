<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentPlatform;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $currencies = Currency::all();
        $paymentPlatforms = PaymentPlatform::all();

        return view('dashboard', compact('currencies', 'paymentPlatforms'));
    }
}
