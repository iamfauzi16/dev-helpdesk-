@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.attendancesReport.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendances-reports.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.attendancesReport.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendancesReport.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="check_in">{{ trans('cruds.attendancesReport.fields.check_in') }}</label>
                <input class="form-control timepicker {{ $errors->has('check_in') ? 'is-invalid' : '' }}" type="text" name="check_in" id="check_in" value="{{ old('check_in') }}">
                @if($errors->has('check_in'))
                    <div class="invalid-feedback">
                        {{ $errors->first('check_in') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendancesReport.fields.check_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="check_out">{{ trans('cruds.attendancesReport.fields.check_out') }}</label>
                <input class="form-control timepicker {{ $errors->has('check_out') ? 'is-invalid' : '' }}" type="text" name="check_out" id="check_out" value="{{ old('check_out') }}">
                @if($errors->has('check_out'))
                    <div class="invalid-feedback">
                        {{ $errors->first('check_out') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendancesReport.fields.check_out_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.attendancesReport.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', '') }}">
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendancesReport.fields.location_helper') }}</span>
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