@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <h6 class="text-muted font-weight-light">Welcome</h6>
           <h3> Hi, {{ auth()->user()->name }}</h3>
        </div>
       
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                <h5 class="text-body">Today</h5>
                <h3 id="time"></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="text-body">{{ trans('cruds.attendancesReport.fields.check_in') }}</h5>
                        <h3 class="text-body">
                            @if(session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </h3>
                    </div>
                </div>
            </div>       
       
    </div>

  
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/time.js') }}"></script>
@endsection