@extends('layouts.master')

@section('content')
    <main>
        <div class="tatweer-page">
            <div class="maintenance-btn"><a href="{{ route('maintenance',App::getLocale()) }}"><img class="maintenance-btn-img" src="{{ asset('assets/images/contact-icon.png') }}" alt=""></a></div>
            <div class="tatweer-hero"
                @if (isset($banner) and $banner->image != null) style="background-image: url({{ $banner->image }});"
                @else
                    style="background-image: url(assets/images/tatweer-hero.png);" @endif>
                <div class="tatweer-hero-caption">
                    <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                        <h1>{{$tr::trans(  $banner->name ?? '', App::getLocale()) }}</h1>
                        <h2>{{ $tr::trans( $banner->slogan ?? '', App::getLocale()) }}</h2>
                    </div>
                </div>
            </div>
            @if (isset($businessCategories) and $businessCategories != null)
                <div class="tatweer-item">
                    @foreach ($businessCategories as $businessCategory)
                        <img class="tatweer-item-img @if ($loop->first) active @endif "
                            id="{{ $businessCategory->_id }}" src="{{ asset($businessCategory->image) }}"alt="">
                    @endforeach
                    <div class="tatweer-item-section">
                        @foreach ($businessCategories as $businessCategory)
                            <div class="tatweer-item-row" data-filter="{{ $businessCategory->_id }}">
                                <div data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                    <a href="{{ route('projects',['slug'=>$businessCategory->slug,'local'=>App::getLocale()]) }}">
                                        <i><img src="{{ asset($businessCategory->icon_image) }}" alt=""></i>
                                        <h3>{{$tr::trans( $businessCategory->name, App::getLocale()) }}</h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            {{-- <!-- Al Saedan Real Estate Company -->
            <section class="Saedan-RealEstate">
                <div class="Saedan-RealEstate-img">
                    <img src="{{ asset('assets/images/RealEstate-hero.png') }}">
                </div>
                <div class="RealEstate-wrapper">
                    <div class="Saedan-RealEstate-content-row">
                        <div class="row m-0">
                            <div class="col-md-4 col-sm-4 p-0" data-aos="fade-up" data-aos-duration="1000"
                                data-aos-delay="100">
                                <div class="RealEstate-img">
                                    <img src="{{ asset('assets/images/RealEstate-img.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 p-0">
                                <div class="Saedan-RealEstate-content">
                                    <h2 data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">شركة آل سعيدان
                                        للعقارات</h2>
                                    <p data-aos="fade-left" data-aos-duration="1000" data-aos-delay="2=300">تُعد شركة آل
                                        سعيدان للعقارات واحدة من أعرق الشركات العقاريّة في المملكة العربيّة السعوديّة
                                        والعالم العربيّ على حدٍ سواء، فكانت انطلاقتها إيماناً بالرغبة الجادة لشركة آل سعيدان
                                        للعقارات بدعم الانطلاقة التنموية التي شهدتها المملكة،</p>
                                    <a data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400"href="#"
                                        class="Saedan-more">-إقرأ المزيد</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Al Saedan Real Estate Company --> --}}

            @if (isset($blogs) and $blogs != null)
                <!-- construction blog -->
                <section class="construction-blog-section">
                    <div class="construction-blog">
                        <div class="construction-blog-left">
                            <h3> {{$tr::trans( "مدونة البناء", App::getLocale()) }} </h3>
                            <div class="construction-blog-row">
                                @foreach ($blogs as $blog)
                                    <div class="construction-blog-item">
                                        <h4>{{ $tr::trans($blog->name, App::getLocale()) }}</h4>
                                        <p>{{ Str::limit(str_replace('&hellip;', ' ', strip_tags($tr::trans($blog->description, App::getLocale()) )), 200) }}
                                        </p>
                                        <a href="{{ route('blog.details', ['slug'=>$blog->slug,'local'=>App::getLocale()]) }}" class="read_more">
                                          {{ $tr::trans('  اقرأ المزيد ', App::getLocale())}}
                                            </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="construction-blog-img">
                            <div class="construction-blog-slider">
                                @foreach ($blogs as $blog)
                                    <div class="construction-blog-item">
                                        <img src="{{ asset($blog->image) }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!-- construction blog -->
            @endif

        </div>
    </main>
@endsection
@push('js')
    <script type="text/javascript">
        $("div.tatweer-item-row").hover(function() {
            $('.tatweer-item-img').removeClass('active');
            var data = $(this).attr('data-filter');
            var element = document.getElementById(data);
            element.classList.add("active");
        });
    </script>
@endpush
