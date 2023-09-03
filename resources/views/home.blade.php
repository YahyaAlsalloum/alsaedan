@extends('layouts.home-master')

@section('content')

    <main>
        <section>
            <div class="home-banner-slider">
                @foreach ($banners as $banner )
                    <div class="home-hero">
                            
                        @if(isset($banner) and $banner->image != null)
                            <embed style="width: 100%; display:block;" src="{{ asset($banner->image) }}"> 
                        @else
                        <embed style="width: 100%; display:block;" src="{{ asset('assets/images/home-hero.jpg') }}">
                        @endif
                        <div class="home-hero-caption">
                            <h2>
                                {{ ucfirst( strtolower($tr::trans( $banner->name??'', App::getLocale()) )) }}</h2>
                            <span>  {{ $tr::trans( $banner->slogan??''  , App::getLocale())}}</span>
                        </div>
                    
                    </div>
                @endforeach
            </div>
        </section>
        <!-- Home About Section -->
        <section class="home_about">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-5 col-sm-6">
                        <div class="home_about_img" data-aos="fade-right">
                            <img src="{{ asset($about->about_image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="home_about_Content">
                            
                            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="50">
                               @php
                               echo $tr::trans( Str::limit(str_replace('&hellip;', ' ', $about->about_us), 100) , App::getLocale());

                               @endphp
                           
                            </div>
                            <h2 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="50">
                                @php

                                    echo   $tr::trans(' رؤيتنا', App::getLocale()) ;
                                @endphp

                            </h2>
                            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="50">
                                @php
                               echo $tr::trans( Str::limit(str_replace('&hellip;', ' ', $about->our_vision), 100) , App::getLocale());
                               @endphp
                               
                            </div>
                            <h2 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="50">
                                {{ $tr::trans(' رسالتنا', App::getLocale()) }} 
                            </h2>
                            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="50">
                                @php
                                echo  $tr::trans( Str::limit(str_replace('&hellip;', ' ', $about->our_message), 100) , App::getLocale()) ;
                                @endphp
                             {{-- {{ LaravelLocalization::getCurrentLocaleName() }} --}}
                            </div>
                            <a href="{{route('about-us', App::getLocale()) }}" class="read_more">+  {{ $tr::trans(  'المزيد'  , App::getLocale())}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      
        <!-- Home Business and development -->
        <section class="home_Business_development">
            <div class="Business_development_slider">
                @foreach ($businessCategories as $businessCategory )
                    
                    <div class="Business_development_item">
                        <img src="{{ asset($businessCategory->image) }}" alt="">
                        <div class="Business_caption">
                            <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                                <h2>{{ ucfirst(strtolower($tr::trans($businessCategory->name , App::getLocale()) ))  }} </h2>
                                <p>{{ Str::limit(str_replace('&hellip;', ' ', strip_tags($businessCategory->description)), 200) }}</p>
                                <a href="{{ route('projects', ['slug'=>$businessCategory->slug, 'local'=>App::getLocale()]) }}" class="read_more">    {{ $tr::trans(  'إقرأ المزيد '  , App::getLocale())}}</a>
                            </div>
                        </div>
                    </div>
                
                @endforeach
            </div>
            <div class="container">
                <div class="Business_development_nav">
                    @foreach ($businessCategories as $businessCategory )
                        <p>{{ ucfirst(strtolower( $tr::trans($businessCategory->name, App::getLocale()))) }} </p>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Home Business and development -->
        <!-- Real estate and investment -->
        <section class="RealEstate-investment">
            <div class="RealEstate-investment-left">
                <div class="RealEstate-investment-slider">
                    @foreach ($realestates as $realestate)
                        <div class="investment-slider-item">
                            <a href="{{ route('realestate-details', ['slug'=>$realestate->slug, 'local'=>App::getLocale()]) }}">
                                @if(isset($realestate->logo) and $realestate->logo != null)
                                    <img src="{{ asset($realestate->logo??'') }}" alt="">
                                @else
                                    <img src="{{ asset('assets/images/default.png') }}" alt="">
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container">
                <div class="RealEstate-investment-right" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                    <h2> {{ $tr::trans(' العقار', App::getLocale()) }}  <br />
                        
                        {{ $tr::trans(' والإستثمار', App::getLocale()) }} 
                    </h2>
                    <ul>
                        <li data-aos="fade-left" data-aos-duration="1000" data-aos-delay="60"><a href="{{route('realestate',App::getLocale() )}}">{{ $tr::trans(' المزيد', App::getLocale()) }} </a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Real estate and investment -->
        <!-- Partners service -->
        <section class="partners_section" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            <div class="container">
                <h3 class="partners_heading">{{ $tr::trans(' خدماتنا', App::getLocale()) }} </h3>
                <ul class="partners_list">
                    @foreach ($services as $service )
                    {{-- serviceCategory_id --}}
                    <li class="services_logo_hover">
                        <a href="{{ route('services', [$service->serviceCategorySlug(),$service->_id],App::getLocale()) }}">
                            <i><img src="{{ asset($service->icon) }}" alt=""></i>
                            <h3>  {{ $tr::trans($service->name , App::getLocale()) }} </h3>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <!-- Partners service -->
    </main>
@endsection
