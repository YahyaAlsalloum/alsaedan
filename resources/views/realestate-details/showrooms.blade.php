<div class="tab_content">
    <div class="container">
        {{-- <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>المباني</h2>
            <p>يـحتوي {{ $realestate->name }} {{ $realestate->showrooms_count }} وحدة سكنية</p>
        </div> --}}
        <ul class="showrooms_click">
            @foreach ($realestate->showrooms() as $showroom)
                <li @if ($loop->first) class="active" style="background: {{ $realestate->main_color }}" @else style="background: {{ $realestate->secondary_color }}" @endif data-filter="#{{ $showroom->_id }}" >
                    {{ $showroom->name }}</li>
            @endforeach
        </ul>
    </div>
    
    @foreach ($realestate->showrooms() as $showroom)
        <div class="showrooms_div @if ($loop->first) active @endif" id="#{{ $showroom->_id }}">
            <div class="container">
                <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
                    <h2>تفاصيل المشروع</h2>
                    <p>يـحتوي {{ $realestate->name }} على {{ $showroom->officesCount() }} مكاتب</p>
                </div>
                <div class="main-showroom-box active" id="main-showroom-box-{{ $showroom->_id }}">
                    
                        @include('realestate-details.office-info')
                                        
                </div>
                <div class="showroom-box" id="showroom-box-{{ $showroom->_id }}">
                   
                </div>
            </div>

        </div>
    @endforeach

</div>
