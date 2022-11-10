@extends('layouts.frontend')

@section('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
{{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if(!empty($attendancesReport))
            <div class="card m-auto" style="width: 20rem;">
                <div class="card-body">
                    <h4 class="card-title">Absensi Masuk</h4>
                    @if(session('error'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('error') }}
                        </div>
                        
                    @endif
                    
                    <form method="POST"  action="{{ route("frontend.attendances-reports.store") }}">
                        @csrf
                        {{-- <div id="leafletMap-registration" style="height: 400px;"></div> --}}
                        
                        <div class="form-group mt-4">
                          <label for="time">Pukul</label>
                          <h3 id="time" class="h3 text-bold"></h3>
                       
                        </div>
                        <div class="form-group mt-4">
                          <label for="location">{{ trans('cruds.attendancesReport.fields.location') }}</label>
                          <input type="search" name="location" class="form-control" id="location">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Absen Masuk</button>
                    </form>
                </div>
            </div>
          @else
          <div class="card m-auto" style="width: 20rem;">
            <div class="card-body">
                <h4 class="card-title">Absensi Keluar</h4>
                @if(session('error'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form method="PATCH"  action="{{ route("frontend.attendances-reports.update") }}">
                    @csrf
                    {{-- <div id="leafletMap-registration" style="height: 400px;"></div> --}}
                    <div class="form-group mt-4">
                      <label for="time">Pukul</label>
                      <h3 id="time" class="h3 text-bold"></h3>
                    </div>
                    <div class="form-group mt-4">
                      @foreach ($attendancesReports as $attendanceReport )
                        <h6>{{ $attendanceReport->location }}</h6>                  
                      @endforeach
                    </div>   
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Absen Keluar</button>
                </form>
            </div>
        </div>
          @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/time.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$('#location').autocomplete({
  source(request, response) {
    const providerform = new GeoSearch.OpenStreetMapProvider({
      params: {
        limit: 5
      }
    });
    return providerform.search({ query: request.term }).then(function (results) {
      response(results);
    });
  },
});
</script>

    
@endsection