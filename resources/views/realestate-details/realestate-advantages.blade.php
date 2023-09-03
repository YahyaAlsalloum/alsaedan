<div class="tab_content">
    <div class="container">
        <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>{{ $realestate->name }}</h2>
        </div>
        <div class="Advantages-box">
            @foreach ($realestate->advantage_values as $advantage)
                <div class="Advantages-box-row" style="border-color: {{ $realestate->secondary_color }}">
                    <div style="color: {{ $realestate->main_color }}">
                        <h3 >{{ $advantage['advantage_name'] }}</h3>
                        {!! $advantage['advantage_description'] !!}
                    </div>
                    <i class="Advantages-icon" style="background: {{ $realestate->main_color }}"><img src="{{ asset($advantage['image']) }}"></i>
                </div>
            @endforeach
        </div>
    </div>
</div>
