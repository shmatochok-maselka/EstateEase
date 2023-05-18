@extends('layouts.admin')
@section('content')
@can('real_estate_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.real-estate-types.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.realEstateType.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.realEstateType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-RealEstateType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.realEstateType.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateType.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.realEstateType.fields.slug') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.realEstateType.fields.photo') }}--}}
{{--                        </th>--}}
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($realEstateTypes as $key => $realEstateType)
                        <tr data-entry-id="{{ $realEstateType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $realEstateType->id ?? '' }}
                            </td>
                            <td>
                                {{ $realEstateType->name ?? '' }}
                            </td>
                            <td>
                                {{ $realEstateType->slug ?? '' }}
                            </td>
{{--                            <td>--}}
{{--                                @if($realEstateType->photo)--}}
{{--                                    <a href="{{ $realEstateType->photo->getUrl() }}" target="_blank" style="display: inline-block">--}}
{{--                                        <img src="{{ $realEstateType->photo->getUrl('thumb') }}">--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </td>--}}
                            <td>
                                @can('real_estate_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.real-estate-types.show', $realEstateType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('real_estate_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.real-estate-types.edit', $realEstateType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('real_estate_type_delete')
                                    <form action="{{ route('admin.real-estate-types.destroy', $realEstateType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('real_estate_type_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.real-estate-types.massDestroy') }}",
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
  let table = $('.datatable-RealEstateType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
