<?php

namespace App\Http\Requests;

use App\Models\RealEstateType;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRealEstateTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('real_estate_type_edit');
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
        ];
    }
}
