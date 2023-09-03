<div class="floor-info @if(isset($active) and $active = true) active @endif" id="#{{ $floor->_id }}">
    <div class="Apartments_list" style="background: {{ $realestate->secondary_color }}"> 
        <div class="Apartments_list_top">


            <h3>{{ $floor->name }}</h3>
            <ul class="Apartments_nav">

                @foreach ($apartmentStatuses as $apartmentStatus)
                    <li @foreach ($realestate->colors as $color)
                        @if($color['colors_id'] == $apartmentStatus->_id)
                            style="background:{{ $color['color'] }};"
                        @endif
                    @endforeach >{{ $apartmentStatus->name }}</li>
                @endforeach

            </ul>
        </div>
        <div class="Apartments_list_row tabap   tab-active">
            @foreach ($floor->apartments() as $apartment)
                <div class="Apartments_list_box"  data-id="#{{ $apartment->_id }}"
                    @if (isset($realestate->colors) and $realestate->colors != null)
                        @foreach ($realestate->colors as $color)
                            @if($color['colors_id'] == $apartment->apartmentStatus->_id)
                                style="background:{{ $color['color'] }};"
                            @endif
                        @endforeach
                    @endif
                    >
                    <div>
                        <ul>
                            <li>
                                <p>رقم الشقة</p>
                                <span>{{ $apartment->number }}</span>
                            </li>
                            <li>
                                <p>عدد الغرف</p>
                                <span>{{ $apartment->rooms }}</span>
                            </li>
                            <li>
                                <p>المساحة</p>
                                <span><sub>
                                        {{-- <img src="{{ asset('assets/images/sign-icon.png') }}" alt=""> --}}
                                    </sub>{{ $apartment->space }}</span>
                            </li>
                            <li>
                                <p>الدور</p>
                                <span>{{ $apartment->floor->name }}</span>
                            </li>
                            <li>
                                <p>القيمة</p>
                                <span>ريال {{ $apartment->price }}</span>
                            </li>
                        </ul>
                        <span class="Apartments_text">
                            {!! $apartment->description !!}</span>
                    </div>
                    <i class="floor_img">
                        <img src="{{ asset('assets/images/floor_img-1.png') }}">
                    </i>
                </div>
            @endforeach
        </div>

    </div>
    <div class="Apartments_msg">
        <ul>
            <li>المساحات تشمل الأجزاء الخاصة*</li>
            <li>الأسعار لاتشمل ضريبة الـتـصـرفـات الـعـقـارية*</li>
        </ul>
    </div>
    @foreach ($floor->apartments() as $apartment)
        <div class="Ground_FloorApartment" id="#{{ $apartment->_id }}">
            <div class="Ground_FloorApartment_top">
                <a></a>
                <div>
                    <ul>
                        <li>مواصفات ومخطط</li>
                        <li>تفاصيل المشروع</li>
                    </ul>
                    <h3 style="color: {{ $realestate->secondary_color }}">الدور ({{ $apartment->floor->name }}) شقة ({{ $apartment->number }})-({{ $apartment->apartmentStatus->name }})</h3>
                </div>
            </div>
            {{-- @dd($apartment) --}}
            @include('modals.request-apartment',['apartment'=>$apartment])
            <div class="floor_info"  >
                <div class="floor_info_row active" style="border-color: {{ $realestate->main_color }};background-color: {{ $realestate->main_color }};">
                    @if($apartment->apartmentStatus_id =='6374be4d0bb191153a019ad2' and isset($apartment->apartmentStatus_id) )
                    <div>
                        <p>انا مهتم  </p>
                        <button  data-toggle="modal"  data-target="#apartmentRequest-{{ $apartment->_id }}" style="background-color: {{ $realestate->secondary_color }};">إرسال</button>
                    </div>
                    @else
                    <div>
                        {{-- <p>
                            {{$filterApartmentStatus_id}}
                        </p> --}}
                       <p>   مباع   </p>
                    </div>
                    @endif
                    {{-- @if($apartment->_id == "6374be4d0bb191153a019ad2")
                    <div>
                        <p>انا مهتم  </p>
                        
                        <button  data-toggle="modal"  data-target="#apartmentRequest-{{ $apartment->_id }}" style="background-color: {{ $realestate->secondary_color }};">إرسال</button>
                    </div>
                    @else
                    <div>
                        <p>{{$apartment->name}}</p>
                        
                        {{-- <button  data-toggle="modal"  data-target="#apartmentRequest-{{ $apartment->_id }}" style="background-color: {{ $realestate->secondary_color }};">إرسال</button> --}}
                    {{-- @if($realestate->status_id =="6374be4d0bb191153a019ad2")
                    <div>
                        <p>انا مهتم  </p>
                        
                        <button  data-toggle="modal"  data-target="#officeRequest-{{ $office->_id }}" style="background-color: {{ $realestate->secondary_color }};">إرسال</button>
                    </div>
                    
                    @elseif ($realestate->status_id =="6374be45ba806120290441e2")
                    <div>
                     
                        <p> محجوز</p>
                    </div>
                   @else 
                   <div>
                    <p> مباع</p>
                    </div>
                    @endif --}}
                </div>
                <div class="floor_info_row" style="border-color: {{ $realestate->main_color }};color: {{ $realestate->main_color }};">
                    <div>
                        <p>:السعر</p>
                        <strong> {{ $apartment->price }} </strong>
                        <span>ريال</span>
                    </div>
                </div>
                <div class="floor_info_row" style="border-color: {{ $realestate->main_color }};color: {{ $realestate->main_color }};">
                    <div>
                        <p>:اجمالي مساحتها</p>
                        <strong>{{ $apartment->space }}</strong>
                    </div>
                </div>
            </div>
            <p class="transaction_tax">الـسـعـر لايـشمـل ضـريبـة الـتـصـرفـات العقـارية</p>

            @if (isset($apartment->advantage_values) and $apartment->advantage_values != null)
                <div class="The_facilities">
                    <h3 class="The_facilities_title" style="color: {{ $realestate->main_color }};">المرافق</h3>
                    <div class="Project-Features">
                        @foreach ($apartment->advantage_values as $advantage)
                            <div class="Project-Features-row" style="background: {{ $realestate->main_color }}">
                                <h3>{{ $advantage['advantage_name'] }} </h3>
                                <i style="background: {{ $realestate->secondary_color }}"><img src="{{ asset($advantage['image']) }}"></i>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if (isset($apartment->image) and $apartment->image != null)
                <div class="Unity-Planner" style="color: {{ $realestate->main_color }};">
                    {{-- <h3 style="color: {{ $realestate->secondary_color }};">مـخـطــط الـوحـــدة</h3> --}}
                    <div class="Unity-Planner_img" style="border-color: {{ $realestate->secondary_color }};">

                        <img src="{{ asset($apartment->image) }}">


                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
