<div class="tab_content">
    <div class="container">
        <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>الخدمات المجانية لما بعد البيع</h2>
            <p>والتي تمتد لسنة كاملة</p>
        </div>
        <div class="Advantages-box">

            @foreach ($realestate->projectServices as $projectService)
                <div class="Advantages-box-row" style="border-color: {{ $realestate->secondary_color }}">
                    <div style="color: {{ $realestate->main_color }}">
                        <h3 >{{ $projectService->name }}</h3>
                    </div>
                    <i class="Advantages-icon" style="background: {{ $realestate->main_color }}"><img src="{{ asset($projectService->image) }}"></i>
                </div>
            @endforeach
        </div>
    </div>
</div>
