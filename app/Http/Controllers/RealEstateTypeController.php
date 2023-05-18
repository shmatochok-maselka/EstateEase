<?php

namespace App\Http\Controllers;

use App\Models\RealEstateType;
use App\Models\RealEstate;

class RealEstateTypeController extends Controller
{

    public function index($slug)
    {
        $realEstateType = RealEstateType::where('slug', $slug)->firstOrFail();

        $realEstates = RealEstate::with('real_estate_types')
            ->whereHas('real_estate_types', function($q) use ($slug) {
                $q->where('real_estate_types.slug', $slug);
            })
            ->latest()
            ->paginate(9);

        return view('real_estate_type', compact('realEstates', 'realEstateType'));
    }

}
