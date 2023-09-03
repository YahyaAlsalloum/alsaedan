@extends('layouts.master')

@section('content')
    <main>
        <div class="realestat-page">
            <div class="realestat-map">
                <div id="map_section" style="width:100%;height:100%"></div>
                
                <form id="realestate-search-form" method="POST" action="{{ route('project.search') }}"class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    <div class="blog-categories">
                        <div class="blog-categories-row">
                            <button type="submit" class="categories_btn">البحث عن العقارات</button>
                        </div>
                        <div class="blog-categories-row">
                            <label>بحث</label>
                            <input type="text" id="keywords" name="keywords" placeholder="بحث" @if(isset($keywords) and $keywords != null) value="{{ $keywords }}" @endif >
                        </div>
                        <div class="blog-categories-row">
                            <label>الوحدات سكنية</label>
                            <input type="number" id="buildingsCount" name="buildingsCount" @if(isset($buildingsCount) and $buildingsCount != null) value="{{ $buildingsCount }}" @endif />
                        </div>
                        <div class="blog-categories-row">
                            <label>المجمّع</label>
                            <select id="projectCategory_id" name="projectCategory_id">
                                <option value="">المجمّعات</option>
                                @foreach ($projectCategories as $projectCategory)
                                    <option value="{{ $projectCategory->_id }}" @if(isset($projectCategory_id) and $projectCategory_id == $projectCategory->_id) selected @endif>{{ $projectCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="blog-categories-row">
                            <label>الحالة</label>
                            <select id="salesStatus_id" name="salesStatus_id">
                                <option value="">الحالة</option>
                                @foreach ($salesStatuses as $salesStatus)
                                    <option value="{{ $salesStatus->id }}" @if(isset($salesStatus_id) and $salesStatus_id == $salesStatus->_id) selected @endif>{{ $salesStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

            </div>

            <div class="container">
                <div class="realestat-intro">
                    <p>تُجسد المجتمعات والمشاريع السكنيّة التابعة لشركة آل سعيدان للعقارات مفهوم الخدمات المُتكاملة، فقد تمّ
                        الحرص على تصميمها بشكلٍ راقٍ، وبأسلوب يُحاكي جميع المُتطلبات الحديثة ويوفر كافّة عوامل الرفاهيّة
                        والراحة والآمان، بالإضافة لتطويرها بشكلٍ يلائم الأفراد أو الأُسر، فضلاً عن موقعها الاستراتيجيّ الذي
                        يلعب دوراً هاماً لبعض الأفراد والموظفين، فكل هذه المميزات استطاعت أن تُمثل دور شركة آل سعيدان
                        للعقارات كشركة رائدة في مجال التطوير العقاري، وتطوير مجتمعات حيويّة ذات جودة عاليّة.</p>
                </div>

                <div class="realestat_tab">
                    <h3>المجتمعات المتاحة </h3>
                
                    <div class="row">
                        @foreach ($realestates as $realestate)
                            <div class="col-md-4 col-sm-6">

                                <a href="{{ route('realestate-details', $realestate->slug) }}">
                                    <div class="realestat_box">
                                        <div class="realestat_img">
                                            <img src="{{ asset($realestate->logo) }}" alt="">
                                        </div>
                                        <div class="realestat_info" style="background-color: {{ $realestate->salesStatus->color}}9e">
                                            <h2>{{ $realestate->name }}</h2>
                                            <p>{{ $realestate->address }}</p>
                                            <ul>
                                                <li>وحدة سكنية {{ $realestate->buildings_count }}<i><img
                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                            alt=""></i></li>
                                                <li>طوابق {{ $realestate->floors_count }}<i><img
                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                            alt=""></i></li>
                                                <li>شقق {{ $realestate->apartments_count }}<i><img
                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                            alt=""></i></li>
                                              
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        
                    </div>
                
                    


                </div>

            </div>

        </div>
    </main>
@endsection
@push('js')
    <script>
        var myMap;
        var app = @json($realestates);

        var markers = [];
        var inital_lng_val = app[0].location['1'];
        var inital_lat_val = app[0].location['0'];
        inital_lng_val = inital_lng_val != '' ? inital_lng_val : '45.0792';
        inital_lat_val = inital_lat_val != '' ? inital_lat_val : '23.8859';

        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(inital_lat_val, inital_lng_val),
                zoom: 10,
                scrollwheel: false,
                mapTypeControl: true,
                fullscreenControl: true,
                mapTypeId: google.maps.MapTypeId.MAP
            };
            myMap = new google.maps.Map(document.getElementById("map_section"), mapOptions);
            //
            for (let i = 0; i < app.length; i++) {
                
                lat = parseFloat(app[i].location['0']) || 0;
                lng = parseFloat(app[i].location['1']) || 0;
    
                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng), // Van Munching Hall,
                    map: myMap,
                    title: app[i].name,
                    icon: app[i].project_category_image,
                });
                
                const infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(markers[i], 'click', function() {
                    infowindow.close(); // Close previously opened infowindow
                    infowindow.setContent('<a href="/realestate-details/' + app[i].slug + '" >' + markers[i].title + '</a>');
                    infowindow.open(myMap, markers[i]);
                                
                });
            }
            // google.maps.event.addDomListener(window, 'load', initMap);
            
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPQfukDXQUdWN4XNMa8asJryBPtJ9iBsQ&callback=initMap">
    </script>
@endpush
