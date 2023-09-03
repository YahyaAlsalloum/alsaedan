<div class="Project-Features-wrapper">
    <div class="container">
        <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>مميزات المشروع</h2>
            <p>أبرز مميزات المشروع</p>
        </div>
        <div class="Project-Features">
            @foreach ($realestate->projectFeatures as $projectFeature)
                <div class="Project-Features-row" style="background: {{ $realestate->main_color }}">
                    <h3>{{ $projectFeature->name }}</h3>
                    <i style="background: {{ $realestate->secondary_color }}"><img src="{{ asset($projectFeature->image) }}" alt=""></i>
                </div>
            @endforeach
        </div>
    </div>
</div>
