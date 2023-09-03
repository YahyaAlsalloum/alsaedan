@extends('layouts.master')

@section('content')
@push('css')
<style>
.gmnoprint{
    top:40px!important;
}
</style>
@endpush
    <main>
        <div class="deem-page" style="background: {{ $realestate->main_color }}">
            <div class="deem-topbar-heading">
                <div class="container">
                    <h1 >{{ $realestate->name }}</h1>
                    <ul>
                        {{-- <li>مشروع سكني متكامل </li> --}}
                        @if(isset($realestate->project_category_name) and $realestate->project_category_name !=null and $realestate->project_category_name !='')
                        <li> {{ $tr::trans($realestate->project_category_name, App::getLocale())}}</li>
                        @else
                        <li>    {{ $tr::trans('مشروع سكني متكامل   ', App::getLocale())}}</li>
                        @endif
                        <li>{{ $realestate->address }}</li>
                    </ul>
                </div>
            </div>
            <div class="deem-hero">
                <div class="deem-hero-left">
                    <img src="{{ asset($realestate->cover_image) }}" alt="">
                </div>
                <div class="deem-hero-right">
                    {{-- <i><img src="{{ asset('assets/images/deep-logo.png') }}" alt=""></i> --}}
                    <h2>  {{ $tr::trans($realestate->name, App::getLocale())}}</h2>
                    {!! $tr::trans($realestate->description, App::getLocale()) !!}
                </div>
            </div>
            <div class="deem-tabs" >
                <div class="tab" data-id="tab1">
                    <div class="deem-tabs-img">
                        {{-- <img src="{{ asset('assets/images/tab-10-img.png') }}" alt=""> --}}
                    </div>
                </div>
                <div class="tab" data-id="tab2">
                    <div class="deem-tabs-img"> <img src="{{ asset('assets/images/tab-9-img.jpg') }}" alt="">
                    </div>
                </div>
                <div class="tab" data-id="tab3">
                    <div class="deem-tabs-img">
                        
                        @if(isset($realestate->gallery_banner) and $realestate->gallery_banner != null) 
                        <img src="{{ asset($realestate->gallery_banner) }}" alt="">
                         @else 
                        <img src="{{ asset('assets/images/tab-9-img.jpg') }}" alt="">
                        @endif
                        {{-- <img src="{{ asset('assets/images/tab-8-img.png') }}" alt=""> --}}
                    </div>
                </div>
                <div class="tab" data-id="tab4">
                    {{-- {{ asset($realestate->cover_image) }} --}}
                    {{-- @dd($realestate) --}}
                    @if($realestate->banner !=null and isset($realestate->banner))
                    <div class="deem-tabs-img"> <img src="{{ asset($realestate->banner) }}" alt="">
                    </div>
                    @else
                    <div class="deem-tabs-img" style="min-height: 420px;background:{{ $realestate->main_color }}">
                    </div>
                    @endif

                </div>
                <div class="tab" data-id="tab5">
                    <div class="deem-tabs-img">
                        
                        @if(isset($realestate->guarantees_banner) and $realestate->guarantees_banner != null) 
                        <img src="{{ asset($realestate->guarantees_banner) }}" alt="">
                         @else  <img src="{{ asset('assets/images/tab-6-img.jpg') }}" alt="">
                         @endif
                    </div>
                </div>
                <div class="tab" data-id="tab6">
                    <div class="deem-tabs-img"> 
                        @if(isset($realestate->gift_banner) and $realestate->gift_banner != null) 
                        <img src="{{ asset($realestate->gift_banner) }}" alt="">
                         @else 
                        <img src="{{ asset('assets/images/tab-5-img.jpg') }}" alt="">
                        @endif
                    </div>
                </div>
                <div class="tab" data-id="tab7">
                    <div class="deem-tabs-img"> @if(isset($realestate->features_banner) and $realestate->features_banner != null) 
                        <img src="{{ asset($realestate->features_banner) }}" alt="">
                         @else  <img src="{{ asset('assets/images/tab-4-img.jpg') }}" alt="">
                          @endif
                    </div>
                </div>
                <div class="tab" data-id="tab8">

                    <div class="home_video">
                        <video id="video">
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                        </video>
                        <div class="play overlay">
                            <img src="{{ asset('assets/images/play-icon.png') }}" alt="play">
                            <span> {{ $tr::trans('داخل شقة العرض<', App::getLocale())}}  </span>
                        </div>
                    </div>
                </div>
                <div class="tab" data-id="tab9">
                    <div id="map_section_details" class="deem-tabs-img"> 
                    </div>
                </div>
                <div class="tab " data-id="tab10">
                    <div class="deem-tabs-img"> @if(isset($realestate->advantages_banner) and $realestate->advantages_banner != null) <img src="{{ asset($realestate->advantages_banner) }}" alt=""> @else <img src="{{ asset('assets/images/deem-tabs-img-1.jpg') }}" alt=""> @endif
                    </div>
                </div>
                <div class="tab-menu" style="background:{{ $realestate->secondary_color }}">
                    <ul>
                        {{-- <li>
                            <a href="JavaScript:void(0);" class="tab-a" data-id="tab1">
                                <i><img src="{{ asset('assets/images/download-file.png') }}"></i>
                                <p>تحميل الملف</p>
                            </a>
                        </li> --}}
                        <li>
                            <a href="JavaScript:void(0);" class="tab-a" data-id="tab3">

                                <i><img src="{{ asset('assets/images/Gallery-icon.png') }}" alt=""></i>
                                <p>  {{ $tr::trans('صالة عرض ', App::getLocale())}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="JavaScript:void(0);" class="tab-a" data-id="tab5">
                                <i><img src="{{ asset('assets/images/Guarantees-icon.png') }}" alt=""></i>
                                <p>   {{ $tr::trans('الضمانات المقدمة  ', App::getLocale())}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="JavaScript:void(0);" class="tab-a" data-id="tab6">
                                <i><img src="{{ asset('assets/images/gift-icon.png') }}" alt=""></i>
                                <p> {{ $tr::trans(' الخدمات المجانية لما بعد البيع  ', App::getLocale())}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="JavaScript:void(0);" class="tab-a" data-id="tab7">
                                <i><img src="{{ asset('assets/images/project-features.png') }}" alt=""></i>
                                <p>  {{ $tr::trans('مميزات المشروع  ', App::getLocale())}}</p>
                            </a>
                        </li>
                        @if (isset($realestate->virtual_navigation) and $realestate->virtual_navigation != null)
                            <li>
                                <a href="{{ $realestate->virtual_navigation }}" target="_blanck" data-id="tab8">
                                    <i><img src="{{ asset('assets/images/videoplay-icon.png') }}" alt=""></i>
                                    <p>  {{ $tr::trans('التجول الإفتراضي  ', App::getLocale())}}</p>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="JavaScript:void(0);" class="tab-a" data-id="tab9">
                                <i><img src="{{ asset('assets/images/Surrounding-icon.png') }}" alt=""></i>
                                <p> {{ $tr::trans(' المعالم المحيطة بالمشروع  ', App::getLocale())}}  </p>
                            </a>
                        </li>
                        <li>
                            <a href="JavaScript:void(0);" class="tab-a" data-id="tab10">
                                <i><img src="{{ asset('assets/images/advantages-icon.png') }}" alt=""></i>
                                <p> {{ $tr::trans(' مزايا المشروع   ', App::getLocale())}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="JavaScript:void(0);" class="tab-a active-a" data-id="tab4" style="background: {{ $realestate->main_color }}">
                                <i><img src="{{ asset('assets/images/apartments-icon.png') }}" alt=""></i>
                                <p> {{ $tr::trans('تفاصيل المشروع ', App::getLocale())}} </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab" data-id="tab1">
            </div>
            @if (isset($realestate->gallery) and $realestate->gallery != null)
                <div class="tab" data-id="tab3">

                    <div class="tab_content">
                        <div class="deem_slider gallery">
                            @foreach ($realestate->gallery as $img)
                                <div class="more_project_item">
                                    <img src="{{ asset($img['url']) }}">
                                </div>
                            @endforeach
                        </div>

                        <div id="fullpage" onclick="this.style.display='none';"></div>
                    </div>

                </div>
            @endif

            <div class="tab tab-active" data-id="tab4">
                @if(isset($realestate->projectCategory_id) and $realestate->projectCategory_id != null)
                    <div class="tab_content">
                        <div class="container">
                            <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
                                <h2>{{ $tr::trans( $realestate->name, App::getLocale()) }}</h2>
                                {{-- <p>يـحتوي {{ $realestate->name }} على ( {{ $realestate->Villas_count }} فيلا ) ( {{ $realestate->buildings_count }} وحدة سكنية)</p> --}}
                            </div>
                            <ul class="info_click">
                                @foreach ($realestate->projectCategory->appearanceModules as $apModule )
                                    <li @if ($loop->first) class="active" style="background: {{ $realestate->main_color }}" @else style="background: {{ $realestate->secondary_color }}" @endif data-filter="#{{ $apModule->slug }}" >
                                    {{ $tr::trans( $apModule->display_title, App::getLocale()) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                
                    @foreach ($realestate->projectCategory->appearanceModules as $apModule )
                        @if($apModule->slug == 'buildings')
                        <div class="info_div @if ($loop->first) active @endif" id="#buildings">
                            @include('realestate-details.buildings-and-floors')
                        </div>
                        @endif
                        @if($apModule->slug == 'villas')
                            <div class="info_div @if ($loop->first) active @endif" id="#villas">
                                @include('realestate-details.villas')
                            </div>
                        @endif
                        @if($apModule->slug == 'lands')
                            
                            <div class="info_div @if ($loop->first) active @endif" id="#lands">
                                @include('realestate-details.lands')
                            </div>
                        @endif
                        @if($apModule->slug == 'showrooms')
                            <div class="info_div @if ($loop->first) active @endif" id="#showrooms">
                                @include('realestate-details.showrooms')
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>
            <div class="tab" data-id="tab5">
                @include('realestate-details.realestate-guarantees')
            </div>
            <div class="tab" data-id="tab6">
                @include('realestate-details.realestate-services')
            </div>
            <div class="tab" data-id="tab7">
                @include('realestate-details.realestate-features')
            </div>
            <div class="tab" data-id="tab8">
                 {{ $tr::trans( 'Video', App::getLocale()) }}
            </div>
            <div class="tab" data-id="tab9">
                @include('realestate-details.realestate-surrounding')
            </div>
            <div class="tab " data-id="tab10">
                @include('realestate-details.realestate-advantages')
            </div>
        </div>
      
        <input type="hidden" id="map_icon" value="{{ asset( $realestate->project_category_image) }}">
        {{-- <div class="more_project_popup">
            <i class="popup_close">X</i>
            <div class="project_popup_midd">
                <img src="{{ asset('assets/images/more-project-1.png') }}" alt="">
            </div>
        </div> --}}
    </main>
@endsection
@push('js')
    <script type="text/javascript">
        // function getPics() {} //just for this demo
        const imgs = document.querySelectorAll('.gallery img');
        const fullPage = document.querySelector('#fullpage');

        imgs.forEach(img => {
            img.addEventListener('click', function() {
                fullPage.style.backgroundImage = 'url(' + img.src + ')';
                fullPage.style.display = 'block';
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var realestate = @json($realestate);
            
            $('#footer').css({
                'background': realestate.secondary_color
            });
        });
    </script>
    <script type="text/javascript">
        var realestate = @json($realestate);
        
        // console.log("#############")
        // console.log(@json($realestate))
        // $(document).ready(function () {
            $('.tab-a').click(function () {

                $(".deem-hero").addClass('hidden');
                $(".tab").removeClass('tab-active');
                $(".tab[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
                $(".tab-a").removeClass('active-a');
                $('.tab-a').css("background", realestate.secondary_color);
                $(this).parent().find(".tab-a").addClass('active-a');
                $(this).css("background", realestate.main_color);
            });
        // });
        $('.info_click li').click(function() {
            $('.info_click li').removeClass('active');
            $('.info_click li').css("background", realestate.secondary_color);
            $('.info_div').removeClass('active');
            $(this).addClass('active');
            $(this).css("background", realestate.main_color);
            var data = $(this).attr('data-filter');
            var element = document.getElementById(data);
            element.classList.add("active");
            // $.scrollTo($(element), 1000);
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
        $('.buildings_click li').click(function() {
            $('.buildings_click li').removeClass('active');
            $('.buildings_click li').css("background", realestate.secondary_color);
            $('.apartments_div').removeClass('active');
            $('.lands_div').removeClass('active');
            $(this).addClass('active');
            $(this).css("background", realestate.main_color);
            var data = $(this).attr('data-filter');
            var element = document.getElementById(data);
            element.classList.add("active");
            // $.scrollTo($(element), 1000);
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        $('.lands_click li').click(function() {
            $('.lands_click li').removeClass('active');
            $('.lands_click li').css("background", realestate.secondary_color);
            $('.lands_div').removeClass('active');
            // $('.buldings_div').removeClass('active');
            $(this).addClass('active');
            $(this).css("background", realestate.main_color);
            var data = $(this).attr('data-filter');
            var element = document.getElementById(data);
            element.classList.add("active");
            // $.scrollTo($(element), 1000);
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        $('.showrooms_click li').click(function() {
            $('.showrooms_click li').removeClass('active');
            $('.showrooms_click li').css("background", realestate.secondary_color);
            $('.showrooms_div').removeClass('active');
            $('.lands_div').removeClass('active');
            // $('.buldings_div').removeClass('active');
            $(this).addClass('active');
            $(this).css("background", realestate.main_color);
            var data = $(this).attr('data-filter');
            var element = document.getElementById(data);
            element.classList.add("active");
            // $.scrollTo($(element), 1000);
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        $('.apartments_click li').click(function() {
            $('.apartments_click li').removeClass('active');
            $('.apartments_click li').css("background", realestate.secondary_color);
            $('.floor-info').removeClass('active');
            $(this).addClass('active');
            $(this).css("background", realestate.main_color);
            var data = $(this).attr('data-id');
            var element = document.getElementById(data);
            element.classList.add("active");
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        });
        $('.Apartments_list_box').click(function() {
            $('.Apartments_list_box').removeClass('active');
            $('.Ground_FloorApartment').removeClass('active');
            $(this).addClass('active');
            var data = $(this).attr('data-id');
            var element = document.getElementById(data);
            element.classList.add("active");
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        });
        $('.plots_list_box').click(function() {
            $('.plots_list_box').removeClass('active');
            $('.Ground_FloorApartment').removeClass('active');
            $(this).addClass('active');
            var data = $(this).attr('data-id');
            var element = document.getElementById(data);
            element.classList.add("active");
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        });
        $('.offices_list_box').click(function() {
            $('.offices_list_box').removeClass('active');
            $('.Ground_FloorApartment').removeClass('active');
            $(this).addClass('active');
            var data = $(this).attr('data-id');
            var element = document.getElementById(data);
            element.classList.add("active");
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(".SubmitAjaxForm").on("click", function() {


                var building_id = $(this).attr('data-filter');
                let searchRooms = $('#searchRooms-' + building_id).val();
                let searchFloor_id = $('#searchFloor_id-' + building_id).val();
                let apartmentStatus_id = $('#apartmentStatus_id-' + building_id).val();
                let keywords = $('#keywords-' + building_id).val();
                let realestate_id = $('#realestate_id-' + building_id).val();
             
                // console.log(apartmentStatus_id);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('ajax.search') }}',
                    data: {
                        keywords: keywords,
                        searchRooms: searchRooms,
                        searchFloor_id: searchFloor_id,
                        apartmentStatus_id: apartmentStatus_id,
                        building_id: building_id,
                        realestate_id: realestate_id,
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#floor-box-' + building_id).html(data.view);
                        $('#main-floor-box-' + building_id).removeClass('active');
                        $('#floor-box-' + building_id).addClass('active');
                    },
                    error: function(data) {}
                });
            });
        })
    </script>

    <script type="text/javascript">
        //  $('.gmnoprint').css('top', '40');
    //      var elem_test,
    // style_test;
    // elem_test = document.querySelector('.gmnoprint');
    // style_test = getComputedStyle(elem_test);
    // console.log(style_test)
        // var yourVar = parseInt($('.gmnoprint').css('top'),0);
        // console.log(yourVar)
        
        var myMap;
        var app = @json($realestate);
    //    console.log(app.project_category_name);
    //    console.log(app.address_points);
        let icon_url=document.getElementById("map_icon").value;
           
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
           if(app.address_points != null && app.address_points !=''){
            var points=[]; 
            console.log('not empty');
            for(var i=0; i<app.address_points.length; i++) { 
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
                    icon: icon_url
                });
               
                const infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(markers, 'click', function() {
                    infowindow.close(); // Close previously opened infowindow
                    infowindow.setContent('<a style="color:black;font-size:1.5rem;" href="/realestate-details/' + app.slug + '" >' + markers.title + '</a>');
                    infowindow.open(myMap, markers);
                                
                });
            
            // google.maps.event.addDomListener(window, 'load', initMap);
            
        }

        $(function() {
            
            $(".submitVillaForm").on("click", function() {
                
                var error = false;
                var id = $(this).attr('data-id');
                let name = $('#vl_name-' + id).val();
                let phone = $('#vl_phone-' + id).val();
                let email = $('#vl_email-' + id).val();
                let payment = $('#vl_payment-' + id).val();
                let villa = $('#vl_villa_id-' + id).val();
                let realestate = $('#vl_realestate_id-' + id).val();
                if (email == '') {
                    $('#vl_email-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#vl_email-' + id).css('border', '1px solid #be966f');
                }   
                if (payment == '') {
                    $('#vl_payment-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#vl_payment-' + id).css('border', '1px solid #be966f');
                }   
                if (phone == '') {
                    $('#vl_phone-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#vl_phone-' + id).css('border', '1px solid #be966f');
                }  
                if (name == '') {
                    $('#vl_name-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#vl_name-' + id).css('border', '1px solid #be966f');
                } 
                if (!error) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('request.villa') }}',
                        cache: false,
                        data: {
                            name: name,
                            phone: phone,
                            email: email,
                            villa: villa,
                            payment: payment,
                      
                            realestate: realestate,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            } else {
                                toastr.error(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            }
                            $('#villaRequest-' + id).modal('hide');
                        },
                        error: function() {
                            // alert("Error");
                            
                            toastr.error('عذرًا! هناك خطأ ما!');
                            toastr.options =
                            {
                                "timeOut" : 1000
                            }
                        }
                    });
                }else{
                    toastr.error('يرجى تعبئة جميع الحقول المطلوبة');
                    toastr.options =
                            {
                                "timeOut" : 1000
                            }
                }
            });
        })
        $(function() {
            
            $(".submitApartmentForm").on("click", function() {
                
                var error = false;
                var id = $(this).attr('data-id');
                let name = $('#ar_name-' + id).val();
                let phone = $('#ar_phone-' + id).val();
                let email = $('#ar_email-' + id).val();
                let payment = $('#ar_payment-' + id).val();
                let apartment = $('#ar_apartment_id-' + id).val();
                let floor = $('#ar_floor_id-' + id).val();
                let building = $('#ar_building_id-' + id).val();
                let realestate = $('#ar_realestate_id-' + id).val();
                if (email == '') {
                    $('#ar_email-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#ar_email-' + id).css('border', '1px solid #be966f');
                }  
                if (payment == '') {
                    $('#ar_payment-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#ar_payment-' + id).css('border', '1px solid #be966f');
                }   
                if (phone == '') {
                    $('#ar_phone-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#ar_phone-' + id).css('border', '1px solid #be966f');
                }  
                if (name == '') {
                    $('#ar_name-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#ar_name-' + id).css('border', '1px solid #be966f');
                } 
                if (!error) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('request.apartment') }}',
                        cache: false,
                        data: {
                            name: name,
                            phone: phone,
                            email: email,
                            payment: payment,
                            apartment: apartment,
                            floor: floor,
                            building: building,
                            realestate: realestate,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            } else {
                                toastr.error(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            }                          
                            $('#apartmentRequest-' + id).modal('hide');

                        },
                        error: function() {
                            // alert("Error");
                            
                            toastr.error('عذرًا! هناك خطأ ما!');
                            toastr.options =
                            {
                                "timeOut" : 1000
                            }
                        }
                    });
                }else{
                    toastr.error('يرجى تعبئة جميع الحقول المطلوبة');
                    toastr.options =
                            {
                                "timeOut" : 1000
                            }
                }
            });
        })
        $(function() {
            
            $(".submitPlotForm").on("click", function() {
                
                var error = false;
                var id = $(this).attr('data-id');
                let name = $('#pl_name-' + id).val();
                let phone = $('#pl_phone-' + id).val();
                let email = $('#pl_email-' + id).val();
                let payment = $('#pl_payment-' + id).val();
                let plot = $('#pl_plot_id-' + id).val();
                let realestate = $('#pl_realestate_id-' + id).val();
                let land = $('#pl_land_id-' + id).val();
                
                if (email == '') {
                    $('#pl_email-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#pl_email-' + id).css('border', '1px solid #be966f');
                }  
                if (payment == '') {
                    $('#pl_payment-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#pl_payment-' + id).css('border', '1px solid #be966f');
                }   
                if (phone == '') {
                    $('#pl_phone-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#pl_phone-' + id).css('border', '1px solid #be966f');
                }  
                if (name == '') {
                    $('#pl_name-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#pl_name-' + id).css('border', '1px solid #be966f');
                } 
                if (!error) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('request.plot') }}',
                        cache: false,
                        data: {
                            name: name,
                            phone: phone,
                            email: email,
                            plot:plot,
                            payment: payment,
                            land:land,
                            realestate:realestate,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            } else {
                                toastr.error(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            }                          
                            $('#plotRequest-' + id).modal('hide');

                        },
                        error: function() {
                            // alert("Error");
                            
                            toastr.error('عذرًا! هناك خطأ ما!');
                            toastr.options =
                            {
                                "timeOut" : 1000
                            }
                        }
                    });
                }else{
                    toastr.error('يرجى تعبئة جميع الحقول المطلوبة');
                    toastr.options =
                            {
                                "timeOut" : 1000
                            }
                }
            });
        })
        $(function() {
            
            $(".submitOfficeForm").on("click", function() {
                
                var error = false;
                var id = $(this).attr('data-id');
                let name = $('#of_name-' + id).val();
                let phone = $('#of_phone-' + id).val();
                let email = $('#of_email-' + id).val();
                let payment = $('#office_payment-'+ id).val();
                let office = $('#of_office_id-' + id).val();
                let realestate = $('#of_realestate_id-' + id).val();
                let floor = $('#of_floor_id-' + id).val();
                
                if (email == '') {
                    $('#of_email-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#of_email-' + id).css('border', '1px solid #be966f');
                }  
                if (payment == '') {
                    $('#of_payment-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#of_payment-' + id).css('border', '1px solid #be966f');
                }   
                if (phone == '') {
                    $('#of_phone-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#of_phone-' + id).css('border', '1px solid #be966f');
                }  
                if (name == '') {
                    $('#of_name-' + id).css('border', '1px solid red');
                    error = true;
                }else{
                    $('#of_name-' + id).css('border', '1px solid #be966f');
                } 
                if (!error) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('request.office') }}',
                        cache: false,
                        data: {
                            name: name,
                            phone: phone,
                            email: email,
                            floor:floor,
                            payment: payment,
                            office:office,
                            realestate:realestate,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            } else {
                                toastr.error(response.message, 'حجز شقة');
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                            }                          
                            $('#officeRequest-' + id).modal('hide');

                        },
                        error: function() {
                            // alert("Error");
                            
                            toastr.error('عذرًا! هناك خطأ ما!');
                            toastr.options =
                            {
                                "timeOut" : 1000
                            }
                        }
                    });
                }else{
                    toastr.error('يرجى تعبئة جميع الحقول المطلوبة');
                    toastr.options =
                            {
                                "timeOut" : 1000
                            }
                }
            });
        })
        $(function() {
            
            
            $(".HideAjaxForm").on("click", function() {
                var building_id = $(this).attr('data-filter');
                $('#main-floor-box-' + building_id).addClass('active');
                $('#floor-box-' + building_id).removeClass('active');
            });
        
        })
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPQfukDXQUdWN4XNMa8asJryBPtJ9iBsQ&callback=initMap">
    </script>
@endpush
