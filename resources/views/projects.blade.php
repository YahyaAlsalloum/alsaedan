@extends('layouts.master-no-footer')

@section('content')
    <main>
        <div class="projects-page">
            <div class="projects-page-top active" id="projects-page-top">
                <div class="container">
                    <div class="top-heading" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <hr>
                        <h1>  {{ $tr::trans($businessCategory->name, App::getLocale())}} </h1>
                    </div>
                    <div class="top-intro" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">{!!  $businessCategory->description!!}</div>
                </div>
            </div>
            @if(isset($businesses) and $businesses != null)
                <section class="projects-slider-section">
                    <div class="projects-slider">
                        @foreach ($businesses as $indexKey => $business )
                            <div class="projects-slider-item" style="background-image: url({{ asset($business->cover_image) }});">
                                {{-- <img class="projects-slider-image" src="{{ asset($business->cover_image) }}" alt=""> --}}
                                <p class="total_no">{{ $indexKey+1 }}<span>/{{ $loop->count }}</span></p>
                                <div class="projects-slider-caption">
                                    <div class="container">
                                        <a href="{{ route('project.details',['slug'=>$business->slug,'local' => App::getLocale()]) }}">
                                            <div>
                                                {{-- <h2><i><img src="{{ asset('assets/images/add-icon.png') }}" alt=""></i>إبراهيم سنتر</h2> --}}
                                                <h2><i><img src="{{ asset('assets/images/add-icon.png') }}" alt=""></i>{{$tr::trans( $business->name ,App::getLocale()) }}</h2>
                                                <a href="{{ route('project.details',['slug'=>$business->slug,'local' => App::getLocale()]) }}">{{ $tr::trans($business->address_title, App::getLocale()) }}</a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </main>
@endsection
