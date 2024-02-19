<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function listCountry()
    {
        // $countries = Country::with('shops')->get();
        $countries = Country::withCount('shops')->get();
        return view('welcome', compact('countries'));
    }
}
