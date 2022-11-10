<?php

namespace App\Http\Requests;

use App\AttendancesReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAttendancesReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('attendances_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:attendances_reports,id',
        ];
    }
}
