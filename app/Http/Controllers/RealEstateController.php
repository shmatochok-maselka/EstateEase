<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;

class RealEstateController extends Controller
{

    public function show($slug, $id) {
        $realEstate = RealEstate::with('real_estate_types', 'location')->where('slug', $slug)->where('id', $id)->firstOrFail();

        $relatedRealEstate = RealEstate::with('real_estate_types')->where('location_id', $realEstate->location_id)->where('id', '!=', $realEstate->id)->take(3)->get();

        return view('real_estate', compact('realEstate', 'relatedRealEstate'));
    }

}
