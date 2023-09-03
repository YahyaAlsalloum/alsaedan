<div class="showroom-info @if(isset($active) and $active = true) active @endif" id="#{{ $showroom->_id }}">
    <div class="Apartments_list" style="background: {{ $realestate->secondary_color }}"> 
        <div class="Apartments_list_top">


            <h3>{{ $showroom->name }}</h3>
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
            @foreach ($showroom->offices() as $office)
                <div class="Apartments_list_box"  data-id="#{{ $office->_id }}"
                    @if (isset($realestate->colors) and $realestate->colors != null)
                        @foreach ($realestate->colors as $color)
                            @if($color['colors_id'] == $office->apartmentStatus->_id)
                                style="background:{{ $color['color'] }};"
                            @endif
                        @endforeach
                    @endif
                    >
                    <div>
                        <ul>
                            <li>
                                <p>رقم المكتب                                </p>
                                <span>{{ $office->number }}</span>
                            </li>
                            {{-- <li>
                                <p>عدد الغرف</p>
                                <span>{{ $office->rooms }}</span>
                            </li> --}}
                            <li>
                                <p>المساحة</p>
                                <span><sub>
                                        {{-- <img src="{{ asset('assets/images/sign-icon.png') }}" alt=""> --}}
                                    </sub>{{ $office->space }}</span>
                            </li>
                            <li>
                                <p>القيمة</p>
                                <span>ريال {{ $office->price }}</span>
                            </li>
                        </ul>
                        <span class="Apartments_text">
                            {!! $office->description !!}</span>
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

    @foreach ($showroom->offices() as $office)
        <div class="Ground_FloorApartment" id="#{{ $office->_id }}">
            <div class="Ground_FloorApartment_top">
                <a></a>
                <div>
                    <ul>
                        <li>مواصفات ومخطط</li>
                    </ul>
                    <h3 style="color: {{ $realestate->secondary_color }}">قطعة ({{ $office->number }})-({{ $office->apartmentStatus->name }})</h3>
                </div>
            </div>
            @include('modals.request-office',['office'=>$office])
            <div class="floor_info"  >
                <div class="floor_info_row active" style="border-color: {{ $realestate->main_color }};background-color: {{ $realestate->main_color }};">
                    @if($office->apartmentStatus_id =='6374be4d0bb191153a019ad2' and isset($office->apartmentStatus_id) )
                  
                    <div>
                        <p>انا مهتم  </p>
                        
                        <button  data-toggle="modal"  data-target="#officeRequest-{{ $office->_id }}" style="background-color: {{ $realestate->secondary_color }};">إرسال</button>
                    </div>
                    @else
                    <div>
                      
                       <p>   مباع   </p>
                    </div>
                    @endif
                </div>
                <div class="floor_info_row" style="border-color: {{ $realestate->main_color }};color: {{ $realestate->main_color }};">
                    <div>
                        <p>:السعر</p>
                        <strong> {{ $office->price }} </strong>
                        <span>ريال</span>
                    </div>
                </div>
                <div class="floor_info_row" style="border-color: {{ $realestate->main_color }};color: {{ $realestate->main_color }};">
                    <div>
                        <p>:اجمالي مساحتها</p>
                        <strong>{{ $office->space }}</strong>
                    </div>
                </div>
            </div>
            <p class="transaction_tax">الـسـعـر لايـشمـل ضـريبـة الـتـصـرفـات العقـارية</p>

            @if (isset($office->advantage_values) and $office->advantage_values != null)
                <div class="The_facilities">
                    <h3 class="The_facilities_title" style="color: {{ $realestate->main_color }};">المرافق</h3>
                    <div class="Project-Features">
                        @foreach ($office->advantage_values as $advantage)
                            <div class="Project-Features-row" style="background: {{ $realestate->main_color }}">
                                <h3>{{ $advantage['advantage_name'] }} </h3>
                                <i style="background: {{ $realestate->secondary_color }}"><img src="{{ asset($advantage['image']) }}"></i>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if (isset($office->image) and $office->image != null)
                <div class="Unity-Planner" style="color: {{ $realestate->main_color }};">
                    {{-- <h3 style="color: {{ $realestate->secondary_color }};">مـخـطــط الـوحـــدة</h3> --}}
                    <div class="Unity-Planner_img" style="border-color: {{ $realestate->secondary_color }};">

                        <img src="{{ asset($office->image) }}">


                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
