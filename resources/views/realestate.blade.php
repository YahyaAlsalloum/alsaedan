@extends('layouts.master')

@section('content')
    <main>
        <div class="realestat-page">
            <div class="realestat-map">
                <div id="map_section" style="width:100%;height:100%"></div>
                <div class="information-box-div">
                    @foreach ($projectCategories as $category)
                        <div class="map-category-info row">
                            <img class="img-information-box" src="{{ asset($category->image) }}">
                            <div class="p-information-box">{{ $category->name }}</div>
                        </div>
                    @endforeach
                </div>
                <form id="realestate-form" method="POST"
                    action="{{ route('project.search',App::getLocale()) }}"class="form-horizontal form-label-left"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="blog-categories">
                        <div class="blog-categories-row">
                            <button type="submit" class="categories_btn">  {{ $tr::trans('  البحث عن العقارات ', App::getLocale())}} </button>
                        </div>
                        <div class="blog-categories-row">
                            <label>{{ $tr::trans('    بحث  ', App::getLocale())}}</label>
                            <input type="text" id="keywords" name="keywords" placeholder=" {{ $tr::trans('    بحث  ', App::getLocale())}} " >
                        </div>
                        <div class="blog-categories-row">
                            <label>{{ $tr::trans('   الوحدات سكنية   ', App::getLocale())}}</label>
                            <input type="number" id="buildingsCount" name="buildingsCount" />
                        </div>
                        <div class="blog-categories-row">
                            <label> {{ $tr::trans('    المجمّع  ', App::getLocale())}}</label>
                            <select id="projectCategory_id" name="projectCategory_id">
                                <option value=""> {{ $tr::trans('    المجمّعات  ', App::getLocale())}}</option>
                                @foreach ($projectCategories as $projectCategory)
                                    <option value="{{ $projectCategory->_id }}">  {{ $tr::trans( $projectCategory->name , App::getLocale())}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="blog-categories-row">
                            <label> {{ $tr::trans('    الحالة  ', App::getLocale())}}</label>
                            <select id="salesStatus_id" name="salesStatus_id">
                                <option value="">{{ $tr::trans('    الحالة  ', App::getLocale())}}</option>
                                @foreach ($salesStatuses as $salesStatus)
                                    <option value="{{ $salesStatus->id }}"> {{ $tr::trans($salesStatus->name, App::getLocale())}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>


            </div>

            <div class="container">
                <div class="realestat-intro">
                    <p> {{ $tr::trans('
                        تُجسد المجتمعات والمشاريع السكنيّة التابعة لشركة آل سعيدان للعقارات مفهوم الخدمات المُتكاملة، فقد تمّ
                        الحرص على تصميمها بشكلٍ راقٍ، وبأسلوب يُحاكي جميع المُتطلبات الحديثة ويوفر كافّة عوامل الرفاهيّة
                        والراحة والآمان، بالإضافة لتطويرها بشكلٍ يلائم الأفراد أو الأُسر، فضلاً عن موقعها الاستراتيجيّ الذي
                        يلعب دوراً هاماً لبعض الأفراد والموظفين، فكل هذه المميزات استطاعت أن تُمثل دور شركة آل سعيدان
                        للعقارات كشركة رائدة في مجال التطوير العقاري، وتطوير مجتمعات حيويّة ذات جودة عاليّة.', App::getLocale())}}
                        </p>
                </div>

                <div class="realestat_tab">
                    <h3> {{ $tr::trans('    المجتمعات المتاحة   ', App::getLocale())}}</h3>
                    <div class="tab-menu">
                        <ul>
                            @foreach ($projectCategories as $projectCategory)
                                <li>
                                    <a href="JavaScript:void(0);"
                                        class="tab-a @if ($loop->last) active-a @endif"
                                        data-id="{{ $projectCategory->slug }}">
                                        {{ $tr::trans( $projectCategory->name, App::getLocale())}} 

                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach ($projectCategories as $projectCategory)
                        <div class="tab  @if ($loop->last) tab-active @endif"
                            data-id="{{ $projectCategory->slug }}">
                            <ul class="realestat_subtab">
                                @foreach ($salesStatuses as $salesStatuse)
                                    <li><a href="JavaScript:void(0);" class="tab-b "
                                            data-id="{{ $salesStatuse->slug }}"> {{ $tr::trans($salesStatuse->name, App::getLocale())}}</a></li>
                                @endforeach
                                <li><a href="JavaScript:void(0);" class="tab-b active-a  " data-id="all"> {{ $tr::trans('    الكل  ', App::getLocale())}}</a></li>
                            </ul>
                            @foreach ($salesStatuses as $salesStatuse)
                                <div class="tabb "
                                    data-id="{{ $salesStatuse->slug }}">
                                    <div class="row">
                                        @foreach ($salesStatuse->realestates($projectCategory->_id) as $realestate)
                                            @if($realestate->status_id == $active)
                                            <div class="col-md-4 col-sm-6">

                                                <a href="{{ route('realestate-details', ['slug'=>$realestate->slug, 'local'=>App::getLocale()]) }}">
                                                    <div class="realestat_box">
                                                        <div class="realestat_img">
                                                            <img src="{{ asset($realestate->logo) }}" alt="">
                                                        </div>
                                                        <div class="realestat_info" style="background-color: {{ $realestate->salesStatus->color}}9e">
                                                            <h2>{{ $realestate->name }}</h2>
                                                            <p>{{ $realestate->address }}</p>
                                                            @if($projectCategory->slug == 'almgtmaaat-alskny')
                                                            <ul>
                                                                <li>وحدة سكنية {{ $realestate->buildings_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li>طوابق {{ $realestate->floors_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                <li>الشقق {{ $realestate->apartments_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                <li>عدد الفلل {{ $realestate->villas_count }}<i><img
                                                                                src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                                alt=""></i></li>
                                                            </ul>
                                                            @elseif($projectCategory->slug == 'almkhttat-almtor')
                                                            <ul>
                                                                <li>مساحة المخطط {{ $realestate->land_space }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li>عدد قطع الاراضي {{ $realestate->lands_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                
                                                            </ul>
                                                            @else
                                                            <ul>
                                                                <li>عدد المعارض {{ $realestate->showrooms_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li>عدد المكاتب {{ $realestate->offices_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                               
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                            <div class="tabb  tab-active " data-id="all">
                                <div class="row">
                                    @foreach ($salesStatuses as $salesStatuse)
                                        @foreach ($salesStatuse->realestates($projectCategory->_id) as $realestate)
                                        @if($realestate->status_id == $active)
                                            <div class="col-md-4 col-sm-6">

                                                <a href="{{ route('realestate-details', ['slug'=>$realestate->slug,'local'=>App::getLocale()]) }}">
                                                    <div class="realestat_box">
                                                        <div class="realestat_img">
                                                            <img src="{{ asset($realestate->logo) }}" alt="">
                                                        </div>
                                                        <div class="realestat_info" style="background-color: {{ $realestate->salesStatus->color}}9e">
                                                            <h2>{{ $tr::trans($realestate->name , App::getLocale())}} </h2>
                                                            <p> {{ $tr::trans( $realestate->address, App::getLocale())}}</p>
                                                            @if($projectCategory->slug == 'almgtmaaat-alskny')
                                                            <ul>
                                                                {{-- @dd($realestate) --}}
                                                                <li>  {{ $tr::trans(' وحدة سكنية  ', App::getLocale())}}{{ $realestate->buildings_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li> {{ $tr::trans('  طوابق  ', App::getLocale())}}{{ $realestate->floors_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                <li>  {{ $tr::trans(' الشقق ', App::getLocale())}}{{ $realestate->apartments_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                <li>  {{ $tr::trans('  عدد الفلل   ', App::getLocale())}}{{ $realestate->villas_count }}<i><img
                                                                                src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                                alt=""></i></li>
                                                            </ul>
                                                            @elseif($projectCategory->slug == 'almkhttat-almtor')
                                                            <ul>
                                                                
                                                                <li> {{ $tr::trans(' مساحة المخطط   ', App::getLocale())}} {{ $realestate->buildings_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li>   {{ $tr::trans('   عدد قطع الاراضي   ', App::getLocale())}}{{ $realestate->lands_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                
                                                            </ul>
                                                            @else
                                                            <ul>
                                                                <li>  {{ $tr::trans('    عدد المعارض   ', App::getLocale())}} {{ $realestate->showrooms_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li> {{ $tr::trans('    عدد المكاتب   ', App::getLocale())}}  {{ $realestate->offices_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                               
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @else
                                            <div class="col-md-4 col-sm-6">

                                                
                                                    <div class="realestat_box" style="cursor: unset;!important">
                                                        <div class="realestat_img">
                                                            <img src="{{ asset($realestate->logo) }}" alt="">
                                                        </div>
                                                        <div class="realestat_info" style="background-color: {{ $realestate->salesStatus->color}}9e">
                                                            <h2>{{ $tr::trans($realestate->name , App::getLocale())}} </h2>
                                                            <p> {{ $tr::trans( $realestate->address, App::getLocale())}}</p>
                                                            @if($projectCategory->slug == 'almgtmaaat-alskny')
                                                            <ul>
                                                                {{-- @dd($realestate) --}}
                                                                <li>وحدة سكنية {{ $realestate->buildings_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li>طوابق {{ $realestate->floors_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                <li>الشقق {{ $realestate->apartments_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                <li>عدد الفلل {{ $realestate->villas_count }}<i><img
                                                                                src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                                alt=""></i></li>
                                                            </ul>
                                                            @elseif($projectCategory->slug == 'almkhttat-almtor')
                                                            <ul>
                                                                
                                                                <li>مساحة المخطط {{ $realestate->buildings_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li>عدد قطع الاراضي{{ $realestate->lands_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                                
                                                            </ul>
                                                            @else
                                                            <ul>
                                                                <li>عدد المعارض {{ $realestate->showrooms_count }}<i><img
                                                                            src="{{ asset('assets/images/Housing-units.png') }}"
                                                                            alt=""></i></li>
                                                                <li>عدد المكاتب {{ $realestate->offices_count }}<i><img
                                                                            src="{{ asset('assets/images/Floors-icons.png') }}"
                                                                            alt=""></i></li>
                                                               
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                               
                                            </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>

            </div>

        </div>
    </main>
@endsection
@push('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.tab-a').click(function () {

                $(".deem-hero").addClass('hidden');
                $(".tab").removeClass('tab-active');
                $(".tab[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
                $(".tab-a").removeClass('active-a');
                $(this).parent().find(".tab-a").addClass('active-a');
            });
        });
    </script>
    <script>
        var myMap;
        var app = @json($realestates);
        console.log(app);
        var categories = @json($projectCategories);
        // console.log(categories)
        var markers = [];
        var inital_lng_val = app[0].location['1'];
        var inital_lat_val = app[0].location['0'];
        inital_lng_val = inital_lng_val != '' ? inital_lng_val : '45.0792';
        inital_lat_val = inital_lat_val != '' ? inital_lat_val : '23.8859';

        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng('24.2669', '45.1078'),
                zoom: 6,
                scrollwheel: false,
                mapTypeControl: true,
                fullscreenControl: true,
                mapTypeId: google.maps.MapTypeId.MAP
            };
            myMap = new google.maps.Map(document.getElementById("map_section"), mapOptions);
            //
            google.maps.event.addListener(myMap, 'idle', function(e) {


            });
            for (let i = 0; i < app.length; i++) {

                lat = parseFloat(app[i].location['0']) || 0;
                lng = parseFloat(app[i].location['1']) || 0;

                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng), // Van Munching Hall,
                    map: myMap,
                    title: app[i].name,
                    address:app[i].address,
                    icon: app[i].project_category_image,
                });
                
                const infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(markers[i], 'click', function() {
                    infowindow.close(); // Close previously opened infowindow
                    infowindow.setContent('<a style="color:black;font-size:1.2rem;text-align:right;" href="/realestate-details/' + app[i].slug + '" >' + markers[i].title + "<br>" + markers[i].address +
                        '</a>');
                    infowindow.open(myMap, markers[i]);

                });
            }
            // google.maps.event.addDomListener(window, 'load', initMap);

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPQfukDXQUdWN4XNMa8asJryBPtJ9iBsQ&callback=initMap">
    </script>
@endpush
