<?php

namespace App\Http\Controllers;

use App\Models\RealEstateType;
use App\Models\Location;
use App\Models\RealEstate;

class LocationController extends Controller
{

    public function index($slug)
    {
        $location = Location::where('slug', $slug)->firstOrFail();

        $realEstates = RealEstate::with('real_estate_types')
            ->where('location_id', $location->id)
            ->latest()
            ->paginate(9);

        return view('location', compact('realEstates', 'location'));
    }

}
