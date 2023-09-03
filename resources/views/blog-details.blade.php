@extends('layouts.master')

@section('content')
<main>
<style>
  .blog-details-info p {
   
  font-size: 1.2rem;
  line-height: 3rem;
  padding:0 !important;
  color: #fff;
}
.blog-details-info span{
 
  font-size: 1.2rem;
  display: block;
  padding: 0!important;
  color: #fff;

}
  </style>
<div class="blog-details-page">
  <div class="container">
    <div class="blog-details-top">
      <h1>  {!! $tr::trans(  'مدونة البناء   ', App::getLocale())  !!}</h1>
    </div>

    <div class="row">
      <div class="col-md-8 col-sm-8 order-sm-1">
        <div class="blog-details-info">
          <img src="{{ asset($blog->image) }}" alt="">
          <span>{{ $blog->date }}</span>
          <h2>  {!! $tr::trans(  $blog->name, App::getLocale())  !!}</h2>
         
          {!! $tr::trans( $blog->description, App::getLocale())  !!}

        </div>
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="related_blog">
          <p class="related_blog_title">  {!! $tr::trans(  ' أحدث المدونات   ', App::getLocale())  !!}</p>
          @foreach ($blogs as $blg )
            <div class="related_blog_row">
              <a href=" {{ route('blog.details',['slug'=>$blg->slug,'local'=>App::getLocale()]) }}"><img src="{{ asset($blg->image) }}" alt=""></a>
              <span>{{ $blg->date }}</span>
              <h2><a href=" {{ route('blog.details',['slug'=>$blg->slug,'local'=>App::getLocale()]) }}">  {!! $tr::trans( $blg->name, App::getLocale())  !!}</a></h2>
            </div>
           @endforeach
        </div>
      </div>
    </div>

  </div>
</div>

</main>
@endsection
