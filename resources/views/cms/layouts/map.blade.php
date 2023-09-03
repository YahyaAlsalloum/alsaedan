@extends('cms.layouts.app')
@section('content')
    <div id="map"></div>
@endsection

@push('css')
    <style>
        #map {
            height: 100%;
        }
    </style>
@endpush
@push('js')
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANOxazgbcyMtsNVnJ2RnTJFr9bFPyMq_8&callback=initMap">
    </script>
@endpush
