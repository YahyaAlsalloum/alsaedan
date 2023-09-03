<!doctype html>
<html class="no-js" lang="ar">

<head>
    {{-- <title>{{ setting('site.title') }}</title> --}}
    <meta charset="UTF-8">


    {{-- <link rel="icon" href="{{ asset('storage/' . setting('site.logo') . '') }}" type="image/x-icon"> --}}

    <link rel="icon" href="{{ ('assets/images/favicon-icon.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link rel='stylesheet' href='https://unpkg.com/aos@2.3.0/dist/aos.css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stylesheet.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">

</head>

<body>

    <div class="wrapper">
        <!-- start header -->
        @include('partials.header')
        <!-- end header -->
        @yield('content')
        <!-- start footer -->
        {{-- @include('partials.footer') --}}
        <!-- end footer -->
    </div>
    <!-- javascript -->

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src='https://unpkg.com/aos@2.3.0/dist/aos.js'></script>
    <script src="{{ asset('assets/js/custom.js') }}" type="text/javascript" charset="utf-8"></script>
    
@stack('js')

</body>

</html>
