@extends('layouts.master')

@section('content')
    <main>
        <div class="about-page">
            <div class="about-hero">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 p-0">
                            <div class="about-hero-img">
                                <img class="image_class" src="{{ asset($about->about_image) }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 p-0">
                            <div class="about-hero-content">
                                <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">   {{ $tr::trans(  'نبذة عنا'  , App::getLocale())}} </h1>
                                <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
                                    {!! $tr::trans(  $about->about_us  , App::getLocale())   !!} </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="our-vision">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 p-0" style="background: #b9b9b9;">
                            <div class="our-vision-content">
                                <div class="our-vision-row" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-delay="200">
                                    <h2>
                                      
                                        {{ $tr::trans(  'رؤيتنا '  , App::getLocale())}} 

                                    </h2>
                                    <div>{!! $tr::trans( $about->our_vision, App::getLocale()) !!}</div>
                                </div>
                                <div class="our-vision-row" data-aos="fade-down" data-aos-duration="1000"
                                    data-aos-delay="400">
                                    <h2>    {{ $tr::trans(  'رسالتنا '  , App::getLocale())}}</h2>
                                    <p>{!!    $tr::trans(  $about->our_message    , App::getLocale()) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 p-0">
                            <div class="our-vision-img" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                <img src="{{ asset($about->vision_image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Our goals -->
            <section class="our-goals-section">
                <div class="container">
                    <div class="our-goals-top" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                        <h3> {{ $tr::trans(  'أهدافنا '  , App::getLocale())}}</h3>
                        <p>  {{ $tr::trans(  'فيما يأتي مجموعة من الأهداف التي نسعى لتحقيقها كشركة رائدة في مجال التطوير العقاريّ: '  , App::getLocale())}}</p>
                    </div>
                    <ul class="our-goals-list">
                        @foreach ($ourGoals as $goal)
                            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                <i><img src="{{ asset($goal->icon) }}" alt=""></i>
                                <div>{!!    $tr::trans( $goal->description  , App::getLocale()) !!}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <!-- Our goals -->
            <!-- our identity -->
            <section class="our-identity-section" style="background-image: url({{ $about->identity_image }});">
                <div class="identity-content">
                    <div>
                        <h2 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">{{ $tr::trans( 'هويتنا' , App::getLocale())}}</h2>
                        <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">{!!   $tr::trans( $about->our_identity , App::getLocale()) !!}</p>
                    </div>
                </div>
            </section>
            <!-- our identity -->
            @if(isset($managers) and $managers != null and $managers != '[]')
                <!-- our Team -->
                <section class="values-principles-section">
                    <div class="container">
                        <div class="teams-top">
                            <h3>   {{ $tr::trans( 'مجلس الادارة ' , App::getLocale())}}</h3>
                        </div>
                        <div class="row teams-slider">
                            @foreach ($managers as $manager)
                                <div class="col-md-4 teams-slider-item">
                                    <img class="teams-slider-image" src="{{ asset($manager->image) }}" alt="">
                                    <h2 class="teams-slider-name">{{ $tr::trans( $manager->name, App::getLocale())  }}</h2>
                                    <h3 class="teams-slider-position">{{$tr::trans(  $manager->position , App::getLocale()) }}</h3>
                                    <div class="teams-slider-description">{!! $tr::trans( $manager->description, App::getLocale()) !!}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- our Team -->
            @endif
            @if(isset($teams) and $teams != null and $teams != '[]')
                <!-- our Team -->
                <section class="values-principles-section">
                    <div class="container">
                        <div class="teams-top">
                            <h3>{{ $tr::trans( 'فريق العمل ', App::getLocale())}}</h3>
                        </div>
                        <div class="row teams-slider">
                            @foreach ($teams as $team)
                                <div class="col-md-4 teams-slider-item">
                                    <img class="teams-slider-image" src="{{ asset($team->image) }}" alt="">
                                    <h2 class="teams-slider-name">{{ $tr::trans( $team->name, App::getLocale()) }}</h2>
                                    <h3 class="teams-slider-position">{{$tr::trans(  $team->position , App::getLocale())}}</h3>
                                    <div class="teams-slider-description">{!! $tr::trans( $team->description, App::getLocale()) !!}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- our Team -->
            @endif
            <!-- Our values and principles -->
            <section class="values-principles-section">
                <div class="container">
                    <div class="values-principles-top">
                        <h3>  {{ $tr::trans( 'قيمنا و المبادئ' , App::getLocale())}}</h3>
                        <p>                        
                            {{ $tr::trans( ' تعد القيم وهي مجموعة من الصفات الإيجابية ذات الصلة بعمل الشركة والتي تمثل القيم الإطار العام الذي
                            تلتزم به الشركة في أداء رسالتها والسعي لتحقيق رؤيتها بمثابة ميثاق عمل لأفراد الشركة يحملون على
                            عاتقهم واجب الوفاء به، ومن هذه القيم: ' , App::getLocale())}}
                        </p>
                    </div>
                    <ul class="values-principles-list">
                        @foreach ($ourValues as $value)
                            <li data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <div>
                                    <i><img src="{{ asset($value->icon) }}" alt=""></i>
                                    <h3>{{ $tr::trans( $value->name , App::getLocale())}}</h3>
                                    <div>{!! $tr::trans( $value->description, App::getLocale()) !!}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <!-- Our values and principles -->
            <div class="about-info">
                <div class="container">
                    <div class="row">
                        @foreach ($aboutInfos as $info)
                            <div class="col-md-6 col-sm-6">
                                <div class="about-info-row" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-delay="100">
                                    <h2>{{ $tr::trans( $info->name, App::getLocale()) }}</h2>
                                    <div>{!! $tr::trans( $info->description, App::getLocale()) !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
