@extends('layouts.app')

@section('body')
    <div id="map" class="Map--full-screen"></div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@endpush
