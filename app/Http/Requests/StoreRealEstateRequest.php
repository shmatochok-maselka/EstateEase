<?php

namespace App\Http\Requests;

use App\Models\RealEstate;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRealEstateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('real_estate_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
            ],
            'location_id' => [
                'required',
                'integer',
            ],
            'types.*' => [
                'integer',
            ],
            'types' => [
                'required',
                'array',
            ],
            'address' => [
                'string',
                'required',
            ],
            'latitude' => [
                'numeric',
            ],
            'longitude' => [
                'numeric',
            ],
            'area' => [
                'numeric',
                'required',
            ],
            'number_of_rooms' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'number_of_beds' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'floor' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price' => [
                'required',
            ],
            'gallery' => [
                'array',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
