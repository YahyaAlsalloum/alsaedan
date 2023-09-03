<div class="tab_content">
    <div class="container">
        {{-- <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>المباني</h2>
            <p>يـحتوي {{ $realestate->name }} {{ $realestate->lands_count }} وحدة سكنية</p>
        </div> --}}
        <ul class="lands_click">
            @foreach ($realestate->lands() as $land)
                <li @if ($loop->first) class="active" style="background: {{ $realestate->main_color }}" @else style="background: {{ $realestate->secondary_color }}" @endif data-filter="#{{ $land->_id }}" >
                    {{ $land->name }}</li>
            @endforeach
        </ul>
    </div> 
    
    @foreach ($realestate->lands() as $land)
        <div class="lands_div @if ($loop->first) active @endif" id="#{{ $land->_id }}">
            <div class="container">
                <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
                    <h2>تفاصيل المشروع</h2>
                    <p>يـحتوي {{ $realestate->name }} على {{ $land->plotsCount() }} قطع</p>
                </div>
                <div class="main-land-box active" id="main-land-box-{{ $land->_id }}">
                    
                        @include('realestate-details.plot-info')
                                        
                </div>
                <div class="land-box" id="land-box-{{ $land->_id }}">
                   
                </div>
            </div>

        </div>
    @endforeach

</div>
