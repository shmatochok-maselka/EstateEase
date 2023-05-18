@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.realEstateType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estate-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateType.fields.id') }}
                        </th>
                        <td>
                            {{ $realEstateType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateType.fields.name') }}
                        </th>
                        <td>
                            {{ $realEstateType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstateType.fields.slug') }}
                        </th>
                        <td>
                            {{ $realEstateType->slug }}
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.realEstateType.fields.photo') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            @if($realEstateType->photo)--}}
{{--                                <a href="{{ $realEstateType->photo->getUrl() }}" target="_blank" style="display: inline-block">--}}
{{--                                    <img src="{{ $realEstateType->photo->getUrl('thumb') }}">--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estate-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
