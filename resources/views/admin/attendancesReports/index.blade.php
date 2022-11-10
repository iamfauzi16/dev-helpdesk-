@extends('layouts.admin')
@section('content')
@can('attendances_report_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.attendances-reports.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.attendancesReport.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.attendancesReport.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-AttendancesReport">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.attendancesReport.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendancesReport.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendancesReport.fields.check_in') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendancesReport.fields.check_out') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendancesReport.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.attendancesReport.fields.calender') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendancesReports as $key => $attendancesReport)
                        <tr data-entry-id="{{ $attendancesReport->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $attendancesReport->id ?? '' }}
                            </td>
                            <td>
                                {{ $attendancesReport->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $attendancesReport->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $attendancesReport->check_in ?? '' }}
                            </td>
                            <td>
                                {{ $attendancesReport->check_out ?? '' }}
                            </td>
                            <td>
                                {{ $attendancesReport->location ?? '' }}
                            </td>
                            <td>
                                {{ $attendancesReport->date_time ?? '' }}
                            </td>
                            <td>
                                @can('attendances_report_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.attendances-reports.show', $attendancesReport->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('attendances_report_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.attendances-reports.edit', $attendancesReport->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('attendances_report_delete')
                                    <form action="{{ route('admin.attendances-reports.destroy', $attendancesReport->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('attendances_report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.attendances-reports.massDestroy') }}",
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
    pageLength: 25,
  });
  let table = $('.datatable-AttendancesReport:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection