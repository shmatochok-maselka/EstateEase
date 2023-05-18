@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.realEstate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.name') }}
                        </th>
                        <td>
                            {{ $realEstate->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.slug') }}
                        </th>
                        <td>
                            {{ $realEstate->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.location') }}
                        </th>
                        <td>
                            {{ $realEstate->location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.types') }}
                        </th>
                        <td>
                            @foreach($realEstate->types as $key => $types)
                                <span class="label label-info">{{ $types->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.address') }}
                        </th>
                        <td>
                            {{ $realEstate->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.latitude') }}
                        </th>
                        <td>
                            {{ $realEstate->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.longitude') }}
                        </th>
                        <td>
                            {{ $realEstate->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.description') }}
                        </th>
                        <td>
                            {{ $realEstate->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.area') }}
                        </th>
                        <td>
                            {{ $realEstate->area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.number_of_rooms') }}
                        </th>
                        <td>
                            {{ $realEstate->number_of_rooms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.number_of_beds') }}
                        </th>
                        <td>
                            {{ $realEstate->number_of_beds }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.floor') }}
                        </th>
                        <td>
                            {{ $realEstate->floor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.price') }}
                        </th>
                        <td>
                            {{ $realEstate->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.main_photo') }}
                        </th>
                        <td>
                            @if($realEstate->main_photo)
                                <a href="{{ $realEstate->main_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $realEstate->main_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.gallery') }}
                        </th>
                        <td>
                            @foreach($realEstate->gallery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.is_featured') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $realEstate->is_featured ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.realEstate.fields.user') }}
                        </th>
                        <td>
                            {{ $realEstate->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.real-estates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
