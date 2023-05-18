@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.realEstate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.real-estates.update", [$realEstate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.realEstate.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $realEstate->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.realEstate.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $realEstate->slug) }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location_id">{{ trans('cruds.realEstate.fields.location') }}</label>
                <select class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location_id" id="location_id" required>
                    @foreach($locations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('location_id') ? old('location_id') : $realEstate->location->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="types">{{ trans('cruds.realEstate.fields.types') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('types') ? 'is-invalid' : '' }}" name="types[]" id="types" multiple required>
                    @foreach($types as $id => $type)
                        <option value="{{ $id }}" {{ (in_array($id, old('types', [])) || $realEstate->types->contains($id)) ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @if($errors->has('types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.types_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.realEstate.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $realEstate->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.realEstate.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', $realEstate->latitude) }}" step="0.00000001">
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.realEstate.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', $realEstate->longitude) }}" step="0.00000001">
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.realEstate.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $realEstate->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="area">{{ trans('cruds.realEstate.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="number" name="area" id="area" value="{{ old('area', $realEstate->area) }}" step="0.01" required>
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="number_of_rooms">{{ trans('cruds.realEstate.fields.number_of_rooms') }}</label>
                <input class="form-control {{ $errors->has('number_of_rooms') ? 'is-invalid' : '' }}" type="number" name="number_of_rooms" id="number_of_rooms" value="{{ old('number_of_rooms', $realEstate->number_of_rooms) }}" step="1" required>
                @if($errors->has('number_of_rooms'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number_of_rooms') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.number_of_rooms_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="number_of_beds">{{ trans('cruds.realEstate.fields.number_of_beds') }}</label>
                <input class="form-control {{ $errors->has('number_of_beds') ? 'is-invalid' : '' }}" type="number" name="number_of_beds" id="number_of_beds" value="{{ old('number_of_beds', $realEstate->number_of_beds) }}" step="1">
                @if($errors->has('number_of_beds'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number_of_beds') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.number_of_beds_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="floor">{{ trans('cruds.realEstate.fields.floor') }}</label>
                <input class="form-control {{ $errors->has('floor') ? 'is-invalid' : '' }}" type="number" name="floor" id="floor" value="{{ old('floor', $realEstate->floor) }}" step="1">
                @if($errors->has('floor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('floor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.floor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.realEstate.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $realEstate->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_photo">{{ trans('cruds.realEstate.fields.main_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('main_photo') ? 'is-invalid' : '' }}" id="main_photo-dropzone">
                </div>
                @if($errors->has('main_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.main_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gallery">{{ trans('cruds.realEstate.fields.gallery') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gallery') ? 'is-invalid' : '' }}" id="gallery-dropzone">
                </div>
                @if($errors->has('gallery'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gallery') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.gallery_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_featured') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_featured" value="0">
                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ $realEstate->is_featured || old('is_featured', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">{{ trans('cruds.realEstate.fields.is_featured') }}</label>
                </div>
                @if($errors->has('is_featured'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_featured') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.is_featured_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.realEstate.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $realEstate->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.realEstate.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.mainPhotoDropzone = {
    url: '{{ route('admin.real-estates.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="main_photo"]').remove()
      $('form').append('<input type="hidden" name="main_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="main_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($realEstate) && $realEstate->main_photo)
      var file = {!! json_encode($realEstate->main_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="main_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    var uploadedGalleryMap = {}
Dropzone.options.galleryDropzone = {
    url: '{{ route('admin.real-estates.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="gallery[]" value="' + response.name + '">')
      uploadedGalleryMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedGalleryMap[file.name]
      }
      $('form').find('input[name="gallery[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($realEstate) && $realEstate->gallery)
      var files = {!! json_encode($realEstate->gallery) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="gallery[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection