<div class="tab_content">
    <div class="container">
        {{-- <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>المباني</h2>
            <p>يـحتوي {{ $realestate->name }} {{ $realestate->buildings_count }} وحدة سكنية</p>
        </div> --}}
        @if($realestate->buildings() !=null and $realestate->buildings() !="")
        <ul class="buildings_click">
            @foreach ($realestate->buildings() as $building)
                <li @if ($loop->first) class="active" style="background: {{ $realestate->main_color }}" @else style="background: {{ $realestate->secondary_color }}" @endif data-filter="#{{ $building->_id }}" >
                    {{ $tr::trans( $building->name, App::getLocale()) }}</li>
            @endforeach
        </ul> 
        @endif
    </div>
    
    @foreach ($realestate->buildings() as $building)
        <div class="apartments_div @if ($loop->first) active @endif" id="#{{ $building->_id }}">
            <div class="container">
                <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
                    {{-- <h2>تفاصيل المشروع</h2> --}}
                    <p>يـحتوي {{ $realestate->name }} على {{ $building->floorsCount() }} طوابق</p>
                </div>
                <ul class="apartments_click">
                    @foreach ($building->floors() as $floor)
                        <li data-filter="#{{ $building->_id }}" data-id="#{{ $floor->_id }}" style="background: {{ $realestate->secondary_color }}">{{ $floor->name }}</li>
                    @endforeach
                </ul>
                <div class="advanced_search_section">
                    <p class="advanced_search_title">بحث متقدم</p>
                    <div class="advanced_search_row" style="border-color: {{ $realestate->secondary_color }}">

                        <div class="advanced_search_select">
                            <label>عدد الغرف</label>
                            <input type="number"  name="rooms" id="searchRooms-{{ $building->_id }}" placeholder="عدد الغرف" style="border-color: {{ $realestate->secondary_color }}">
                            <input type="hidden" name="building_id" id="searchBuilding_id-{{ $building->_id }}" value="{{ $building->_id }}">
                        </div>
                        <div class="advanced_search_select">
                            <label>الدور</label>
                            <select id="searchFloor_id-{{ $building->_id }}" style="border-color: {{ $realestate->secondary_color }}">
                                <option value="">الدور</option>
                                @foreach ($building->floors() as $floor)
                                    <option value="{{ $floor->_id }}">{{ $floor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="advanced_search_select">
                            <label>الحالة</label>
                            <select id="apartmentStatus_id-{{ $building->_id }}" style="border-color: {{ $realestate->secondary_color }}">
                                <option value="">الحالة</option>
                                @foreach ($apartmentStatuses as $apartmentStatus)
                                    <option value="{{ $apartmentStatus->_id }}">{{ $apartmentStatus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="range_sldier"></div> --}}
                        <div class="advanced_search">
                            <input type="text" id="keywords-{{ $building->_id }}"  placeholder="بحث" style="border-color: {{ $realestate->secondary_color }}">
                            <input type="hidden" id="realestate_id-{{ $building->_id }}" value="{{ $realestate->_id }}">
                            <span class="SubmitAjaxForm" style="background-color: {{ $realestate->main_color }}" data-filter="{{ $building->_id }}" ><i class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                        <span class="HideAjaxForm" style="background-color: {{ $realestate->main_color }}" data-filter="{{$building->_id}}" class="close-ajax-form" ><i class="fa fa-times" aria-hidden="true"></i></span>

                    </div>
                </div>
                <div class="main-floor-box active" id="main-floor-box-{{ $building->_id }}">
                    @foreach ($building->floors() as $floor)
                        @include('realestate-details.floor-info', ['floor' => $floor])
                    @endforeach
                </div>
                <div class="floor-box" id="floor-box-{{ $building->_id }}">
                   
                </div>
            </div>

        </div>
    @endforeach

</div>
