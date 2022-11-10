<?php

namespace App\Http\Controllers\Admin;

use App\AttendancesReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAttendancesReportRequest;
use App\Http\Requests\StoreAttendancesReportRequest;
use App\Http\Requests\UpdateAttendancesReportRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttendancesReportsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendances_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendancesReports = AttendancesReport::with(['user', 'created_by'])->get();

        return view('admin.attendancesReports.index', compact('attendancesReports'));
    }

    public function create()
    {
        abort_if(Gate::denies('attendances_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.attendancesReports.create', compact('users'));
    }

    public function store(StoreAttendancesReportRequest $request)
    {
        $attendancesReport = AttendancesReport::create($request->all());

        return redirect()->route('admin.attendances-reports.index');
    }

    public function edit(AttendancesReport $attendancesReport)
    {
        abort_if(Gate::denies('attendances_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendancesReport->load('user', 'created_by');

        return view('admin.attendancesReports.edit', compact('attendancesReport', 'users'));
    }

    public function update(UpdateAttendancesReportRequest $request, AttendancesReport $attendancesReport)
    {
        $attendancesReport->update($request->all());

        return redirect()->route('admin.attendances-reports.index');
    }

    public function show(AttendancesReport $attendancesReport)
    {
        abort_if(Gate::denies('attendances_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendancesReport->load('user', 'created_by');

        return view('admin.attendancesReports.show', compact('attendancesReport'));
    }

    public function destroy(AttendancesReport $attendancesReport)
    {
        abort_if(Gate::denies('attendances_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendancesReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyAttendancesReportRequest $request)
    {
        AttendancesReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
