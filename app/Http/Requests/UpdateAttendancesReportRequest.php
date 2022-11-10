<?php

namespace App\Http\Requests;

use App\AttendancesReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAttendancesReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('attendances_report_edit');
    }

    public function rules()
    {
        return [
            'check_in' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'check_out' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'location' => [
                'string',
                'nullable',
            ],
        ];
    }
}
