@extends('layouts.admin')
@section('content')
@can('real_estate_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.real-estates.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.realEstate.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.realEstate.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RealEstate">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.slug') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.types') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.latitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.longitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.area') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.number_of_rooms') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.number_of_beds') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.floor') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.main_photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.gallery') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.is_featured') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstate.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($realEstates as $key => $realEstate)
                        <tr data-entry-id="{{ $realEstate->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $realEstate->id ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->name ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->slug ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->location->name ?? '' }}
                            </td>
                            <td>
                                @foreach($realEstate->types as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $realEstate->address ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->latitude ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->longitude ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->description ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->area ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->number_of_rooms ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->number_of_beds ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->floor ?? '' }}
                            </td>
                            <td>
                                {{ $realEstate->price ?? '' }}
                            </td>
                            <td>
                                @if($realEstate->main_photo)
                                    <a href="{{ $realEstate->main_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $realEstate->main_photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($realEstate->gallery as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                <span style="display:none">{{ $realEstate->is_featured ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $realEstate->is_featured ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $realEstate->user->name ?? '' }}
                            </td>
                            <td>
                                @can('real_estate_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.real-estates.show', $realEstate->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('real_estate_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.real-estates.edit', $realEstate->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('real_estate_delete')
                                    <form action="{{ route('admin.real-estates.destroy', $realEstate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('real_estate_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.real-estates.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-RealEstate:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection