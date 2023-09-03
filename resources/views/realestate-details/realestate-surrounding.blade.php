<div class="tab_content">
    <div class="container">
        <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>المعالم المحيطة بالمشروع</h2>
            <p>يمتاز المشروع بقرب الخدمات والطرق الرئيسية </p>
        </div>
        <div class="Advantages-box">
            @foreach ($realestate->surrounding_values as $surrounding)
                <div class="Advantages-box-row" style="border-color: {{ $realestate->secondary_color }}">
                    <div style="color: {{ $realestate->main_color }}">
                        <h3 >{{ $surrounding['surrounding_name'] }}</h3>
                        {!! $surrounding['surrounding_description'] !!}
                    </div>
                    <i class="Advantages-icon" style="background: {{ $realestate->main_color }}"><img src="{{ asset($surrounding['image']) }}"></i>
                </div>
            @endforeach
        </div>
    </div>
</div>
