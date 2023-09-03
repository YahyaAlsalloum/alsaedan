@extends('layouts.master')

@section('content')
    <main>
        <div class="projects-details-page">
            <div class="projects-details-hero">
                <div class="projects-details-item">
                    <img class="projects-details-image" src="{{ asset($business->cover_image) }}">
                    <div class="projects-details-caption">
                        {{-- <p class="next_projects"><img src="{{ asset('assets/images/back-arrow.png') }}"> المشروع التالي</p> --}}
                        <div class="caption-text" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                            <h2>{{ $tr::trans($business->name, App::getLocale()) }}</h2>
                            <a>{{ $tr::trans($business->address_title, App::getLocale()) }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="projects-details-info">
                <div class="container">
                    <div class="row" style="direction: rtl!important;">
                        @if (isset($business->unit_values) and $business->unit_values != null)
                        <div class="col-md-4 col-sm-12">
                            
                            <div class="details-info-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                                <p>
                                    <i><img src="{{ asset('assets/images/home-icon.png') }}" alt=""></i>
                                  
                                   {{ $tr::trans('  عدد الوحدات', App::getLocale())}}
                                </p>
                                <div class="details-info-row">
                                    <div>
                                        <p>
                                          @if (isset($business->unit_values) and $business->unit_values != null)
                                              @foreach ($business->unit_values as $unit)
                                                  {{ $unit['unit_number'] }}<span>{{$tr::trans( $unit['unit_name'], App::getLocale()) }}</span>
                                              @endforeach
                                          @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        @endif
                        @if (isset($business->building_area) and $business->building_area != null and $business->building_area != ' ')
                        <div class="col-md-4 col-sm-12">
                           
                            <div class="details-info-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <p>
                                    <i><img src="{{ asset('assets/images/Commercial-office.png') }}" alt=""></i>
                                    {{ $tr::trans('  (م2)  مسطح البناء  ', App::getLocale())}}    
                                </p>
                                <div class="details-info-row">
                                    <div>
                                        <p>  {{ $tr::trans( $business->building_area , App::getLocale())}}</p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        @endif
                        @if (isset($business->land_area) and $business->land_area != null )
                        <div class="col-md-4 col-sm-12">
                           
                            {{-- @dd($business) --}}
                            <div class="details-info-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                <p>
                                    <i><img src="{{ asset('assets/images/Land-area.png') }}" alt=""></i>
                                    {{ $tr::trans('   مساحة الأرض  ', App::getLocale())}}    (م2)
                                </p>
                                <div class="details-info-row">
                                    <div>
                                        <p>{{ $tr::trans($business->land_area, App::getLocale()) }}</p>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- About the project -->
            <section class="about-project-section">
                <div class="container">
                    <div class="about-project-row">
                        <div class="row align-items-center m-0">
                            <div class="col-md-8 col-sm-7 p-0">
                                <div class="about-project-img">
                                    
                                    <img src="{{ asset($business->image) }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5 p-0">
                                <div class="about-project-info" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-delay="100">
                                    <h2>   {{ $tr::trans(' نبذة عن المشروع    ', App::getLocale())}}</h2>
                                    <p>{!! $tr::trans($business->description, App::getLocale()) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="the-address-row">
                        <div class="row align-items-center m-0">
                            <div class="col-md-4 col-sm-7 p-0 order-sm-2">
                                <div class="about-project-img">
                                    <div id="map_section_details">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-5 p-0 order-sm-1">
                                <div class="about-project-info" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-delay="300">
                                    <h2>   {{ $tr::trans(' العنوان', App::getLocale())}}</h2>
                                    <p>{{ $tr::trans($business->address, App::getLocale()) }}</p>
                                    <a href="http://maps.google.com/?q={{ $business->location['0'] }},{{ $business->location['1'] }}"
                                        target="_blanck" class="pin-btn">      {{ $tr::trans(' الموقع على الخريطة ', App::getLocale())}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About the project -->

            @if (isset($business->gallery) and $business->gallery != null)
                <!-- More Projects -->
                <section class="more_project-section">
                    <div class="more_project_top">
                        <div class="container">
                        </div>
                    </div>
                    <div class="more_project_slider">
                        @foreach ($business->gallery as $img)
                            <div class="more_project_item">
                                <img src="{{ asset($img['url']) }}" alt="">
                            </div>
                        @endforeach

                    </div>
                </section>
                <!-- More Projects -->
            @endif
        </div>
    </main>
@endsection
@push('js')
    <script>
        var myMap;
        var app = @json($business);


        var markers = [];
        var inital_lng_val = app.location['1'];
        var inital_lat_val = app.location['0'];
        inital_lng_val = inital_lng_val != '' ? inital_lng_val : '45.0792';
        inital_lat_val = inital_lat_val != '' ? inital_lat_val : '23.8859';

        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(inital_lat_val, inital_lng_val),
                zoom: 12,
                scrollwheel: false,
                mapTypeControl: true,
                fullscreenControl: true,
                mapTypeId: google.maps.MapTypeId.MAP
            };
            myMap = new google.maps.Map(document.getElementById("map_section_details"), mapOptions);
            //for showing shapes saved in database
            if (app.address_points != null && app.address_points != '') {
                var points = [];
                console.log('not empty');
                for (var i = 0; i < app.address_points.length; i++) {
                    points.push(new google.maps.LatLng(app.address_points[i][0],
                        app.address_points[i][1]));
                }
                // Construct the polygon.
                var bermudaTriangle = new google.maps.Polygon({
                    paths: points,
                    strokeWeight: 0,
                    fillOpacity: 0.45
                });
                bermudaTriangle.setMap(myMap);
            }



            lat = parseFloat(app.location['0']) || 0;
            lng = parseFloat(app.location['1']) || 0;

            markers = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng), // Van Munching Hall,
                map: myMap,
                title: app.name,
            });

            const infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(markers, 'click', function() {
                infowindow.close(); // Close previously opened infowindow
                infowindow.setContent('<a href="/realestate-details/' + app.slug + '" >' + markers.title + '</a>');
                infowindow.open(myMap, markers);

            });


        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPQfukDXQUdWN4XNMa8asJryBPtJ9iBsQ&callback=initMap">
    </script>
@endpush
