<?php

namespace App\Http\Controllers\Frontend;

use App\AttendancesReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAttendancesReportRequest;
use App\Http\Requests\StoreAttendancesReportRequest;
use App\Http\Requests\UpdateAttendancesReportRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;


class AttendancesReportsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendances_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendancesReports = AttendancesReport::with(['user', 'created_by'])->get();

        return view('frontend.attendancesReports.index', compact('attendancesReports'));
    }

    

    public function create()
    {
        abort_if(Gate::denies('attendances_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();

        return view('frontend.attendancesReports.create', compact('users'));
    }

    public function store(StoreAttendancesReportRequest $request)
    {
        $timezone = 'Asia/Jakarta'; 
        $date = new DateTime('now', new DateTimeZone($timezone)); 
        $localtime = $date->format("H:i:s"); 
        $calender = $date->format("Y-m-d");
        $user = Auth::user()->id;
        
        $attendancesReport = AttendancesReport::where('date_time', $calender)->first();
        
        if (!empty($attendancesReport)) {
           return redirect()->back()->with("error", "Kamu Sudah melakukan absensi!");
        } else {
            AttendancesReport::create(
                ['check_in' => $localtime,
                 'location' => $request->location,
                 'user_id'  => $user,
                 'date_time' => $calender,
                ]
            );
            return redirect()->back()->with('success', 'Kamu berhasil absen');
        }

        

    }

    public function edit(AttendancesReport $attendancesReport)
    {
        abort_if(Gate::denies('attendances_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $attendancesReport->load('user', 'created_by');

        return view('frontend.attendancesReports.edit', compact('attendancesReport', 'users'));
    }

    public function update(UpdateAttendancesReportRequest $request, AttendancesReport $attendancesReport)
    {
        $timezone = 'Asia/Jakarta'; 
        $date = new DateTime('now', new DateTimeZone($timezone)); 
        $localtime = $date->format("H:i:s"); 
        $calender = $date->format("Y-m-d");

        $attendancesReport = AttendancesReport::where('attendancesReport', $id)->update([
            'check_out' => $localtime
        ]);

        return redirect()->route('frontend.attendances-reports.index');
    }

    public function show(AttendancesReport $attendancesReport)
    {
        abort_if(Gate::denies('attendances_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendancesReport->load('user', 'created_by');

        return view('frontend.attendancesReports.show', compact('attendancesReport'));
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
