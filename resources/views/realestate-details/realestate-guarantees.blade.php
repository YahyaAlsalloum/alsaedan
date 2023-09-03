<div class="tab_content">
    <div class="container">
        <div class="tab_title" style="color: {{ $realestate->secondary_color }}">
            <h2>الضمانات المقدمة</h2>
            <p>والتي تمتد لسنة كاملة</p>
        </div>
        <div class="Advantages-box">
            @foreach ($realestate->projectGuarantees as $projectGuarantee)
                <div class="Advantages-box-row" style="border-color: {{ $realestate->secondary_color }}">
                    <div style="color: {{ $realestate->main_color }}">
                        <h3 >
                            {{ $projectGuarantee->name }}
                        </h3>
                    </div>
                    <i class="Advantages-icon" style="background: {{ $realestate->main_color }}">
                        @if(isset($projectGuarantee->image) and $projectGuarantee->image !=null and $projectGuarantee->image !='')
                        <img src="{{ asset($projectGuarantee->image) }}">
                        @endif
                    </i>
                </div>
            @endforeach
        </div>
    </div>
</div>
