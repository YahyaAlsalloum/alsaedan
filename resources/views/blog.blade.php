@extends('layouts.master')

@section('content')
    <main>
        <div class="blog-page">
            <div class="container">
                <div class="blog-title">
                    <h1>     {!! $tr::trans(  'مدونة البناء   ', App::getLocale())  !!}</h1>
                </div>
                @if(isset($blogs) and $blogs != null)
                  @foreach ($blogs as $blog )
                    
                    <div class="blog_list">
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <div class="blog-content">
                                    <span>  {!! $tr::trans(   $blog->date, App::getLocale())  !!}</span>
                                    <h2><a href="{{ route('blog.details',['slug'=>$blog->slug,'local'=>App::getLocale()]) }}">{!! $tr::trans(    $blog->name, App::getLocale())  !!}</a></h2>
                                    {{-- {!! $blog->description !!} --}}
                                    {{-- {{ Str::limit() }} --}}
                                    <p>
                                    {{ Str::limit(str_replace(['&hellip;','&nbsp;'], ' ', strip_tags( $tr::trans(   $blog->description , App::getLocale()) )), 200) }}
                                    </p>
                                    <a href="{{ route('blog.details',['slug'=>$blog->slug,'local'=>App::getLocale()]) }}" class="blog_read"> {!! $tr::trans(   '+ المزيد ', App::getLocale())  !!}</a>
                                    {{-- <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//alsaedan.com/blog-details/{{$blog->slug}}"><img class="img-share-icon" src="{{ asset('assets/images/share.png') }}" alt=""></a> --}}
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-6">
                                <div class="blog_img">
                                    <a href="{{ route('blog.details',['slug'=>$blog->slug,'local'=>App::getLocale()]) }}">
                                        <img src="{{ asset($blog->image) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                  @endforeach
                @endif
                <div class="load_more">
                    {{-- <button>أظهر المزيد</button> --}}
                </div>

            </div>
        </div>
    </main>
@endsection
