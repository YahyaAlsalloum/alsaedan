@extends('layouts.master')

@section('content')
    <main>
        <div class="awards-page">
            <div class="container">
                <h1 class="awards-heading">  {{ $tr::trans( 'الخدمة المجتمعية ', App::getLocale()) }}</h1>
                <div class="row m-0">
                    @foreach ($socialServices as $service)
                        <div class="col-md-4 col-sm-6 p-0" data-aos="fade-up" data-aos-duration="000" data-aos-delay="0">
                            <div class="awards-box">
                                <img src="{{ asset($service->image) }}" alt="">
                                <div class="awards-list">
                                  {!! $tr::trans(  $service->description, App::getLocale())  !!}
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="Awards-row">
                <div class="container">
                    <h3 class="more-awards-title">   {!! $tr::trans(  'الجوائز', App::getLocale())  !!}</h3>
                    <div class="row m-0">
                      @foreach ($awards as $award )
                        
                      <div class="col-md-3 col-sm-6 p-1" data-aos="fade-up" data-aos-duration="1000"
                          data-aos-delay="4000">
                          <div class="more-Awards-box">
                              <i><img src="{{ asset($award->image) }}" alt=""></i>
                              <h3>   {!! $tr::trans( $award->name, App::getLocale())  !!}</h3>
                          </div>
                      </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
