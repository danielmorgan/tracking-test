@extends('layouts.app')

@section('body')
    <div class="MapContainer">
        <div id="map" class="Map"></div>
    </div>

    <div class="Content">
        <div class="ContentText">
            @foreach (range(1, 5) as $i)
                @include('partials.filler')
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
<link href="https://fonts.googleapis.com/css?family=Marko+One|Playfair+Display:400,700" rel="stylesheet">
@endpush

@push('scripts')
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@endpush
