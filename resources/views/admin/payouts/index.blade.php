@extends('layouts.admin')
@section('content')
@can('payout_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.payouts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.payout.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.payout.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Payout">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.payout.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.payout.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.payout.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.payout.fields.completed_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.payout.fields.commission') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payouts as $key => $payout)
                        <tr data-entry-id="{{ $payout->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $payout->id ?? '' }}
                            </td>
                            <td>
                                {{ $payout->name ?? '' }}
                            </td>
                            <td>
                                {{ $payout->amount ?? '' }}
                            </td>
                            <td>
                                {{ $payout->completed_at ?? '' }}
                            </td>
                            <td>
                                {{ $payout->commission ?? '' }}
                            </td>
                            <td>
                                @can('payout_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.payouts.show', $payout->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('payout_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.payouts.edit', $payout->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('payout_delete')
                                    <form action="{{ route('admin.payouts.destroy', $payout->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('payout_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.payouts.massDestroy') }}",
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
  let table = $('.datatable-Payout:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection