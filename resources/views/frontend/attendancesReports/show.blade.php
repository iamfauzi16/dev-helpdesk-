@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.attendancesReport.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.attendances-reports.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.attendancesReport.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $attendancesReport->id}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.attendancesReport.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $attendancesReport->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.attendancesReport.fields.check_in') }}
                                    </th>
                                    <td>
                                        {{ $attendancesReport->check_in }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.attendancesReport.fields.check_out') }}
                                    </th>
                                    <td>
                                        {{ $attendancesReport->check_out }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.attendancesReport.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $attendancesReport->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.attendancesReport.fields.calender') }}
                                    </th>
                                    <td>
                                        {{ $attendancesReport->date_time }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.attendances-reports.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection