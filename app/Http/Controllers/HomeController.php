<?php

namespace App\Http\Controllers;

use App\Models\RealEstateType;
use App\Models\Location;
use App\Models\RealEstate;

class HomeController extends Controller
{

    public function index()
    {
        $featuredRealEstates = RealEstate::where('is_featured', 1)->get();
        $realEstateTypes = RealEstateType::all();
        $locations = Location::all();
        $newestRealEstates = RealEstate::with('real_estate_types')->latest()->take(6)->get();
        $min_price = RealEstate::min('price');
        $max_price = RealEstate::max('price');
        return view('home', compact('featuredRealEstates', 'realEstateTypes', 'locations', 'newestRealEstates', 'min_price', 'max_price'));
    }

}
