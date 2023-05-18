<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;

class SearchController extends Controller
{

    public function index()
    {
        $realEstateType = request('real_estate_type');
        $type = request('types');
        $realEstates = RealEstate::whereBetween('price', [request('min_price'), request('max_price')])
            ->when($type, function($query) use ($type) {
                return $query->whereHas('types', function ($query) use ($type) {
                    $query->where('real_estate_types.id', $type);
                });
            })
            ->when(request('location_id'), function($query) {
                return $query->where('location_id', request('location_id'));
            })
            ->when(request('area'), function($query) {
                return $query->where('area', request('area'));
            })
            ->when(request('number_of_rooms'), function($query) {
                return $query->where('number_of_rooms', request('number_of_rooms'));
            })
            ->when(request('number_of_beds'), function($query) {
                return $query->where('number_of_beds', request('number_of_beds'));
            })
            ->when(request('floor'), function($query) {
                return $query->where('floor', request('floor'));
            })
            ->paginate(6);

        return view('search', compact('realEstates', 'realEstateType'));
    }

}
