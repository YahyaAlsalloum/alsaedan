    <!-- Header Start here -->
    <header id="header-home">
      <div class="container">
        <div class="inner-header">
            
            <div class="hamburger_icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="inner-header-logo">
                <a href="{{ route('home',App::getLocale()) }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
            </div>
            <div class="inner-header-left">
                {{-- <ul class="lung">
            <li><a href="#">English</a></li>
            <li><a class="active" href="#"><span>عربي</span></a></li>
          </ul> --}}
                <nav class="inner-nav">
                    <ul id="nav">
                        <li class="hover-nav"><a href="{{ route('home',App::getLocale()) }}">
                            {{ $tr::trans( 'الرئيسية' , App::getLocale())}} </a></li>
                        <li class="hover-nav"><a href="{{ route('about-us',App::getLocale()) }}">
                            {{ $tr::trans( 'من نحن   ' , App::getLocale()) }}
                             </a></li>
                        <li class="hover-nav d-md-block d-lg-none"><a href="{{ route('business',App::getLocale()) }}">
                            {{ $tr::trans( 'التطوير والأعمال' , App::getLocale())}}
                                </a></li>
                        <li class=" hover-nav li-inner d-none d-lg-block"><a href="{{ route('business',App::getLocale()) }}">
                            {{ $tr::trans( 'التطوير والأعمال' , App::getLocale())}}</a>
                            @if (isset($businessCategories) and $businessCategories != null)
                                <ul class="ul-inner">
                                    @foreach ($businessCategories as $businessCategory)
                                        <li class="li-inner-nav">
                                            <a class="a-inner-nav"
                                                href="{{ route('projects', ['slug'=>$businessCategory->slug,'local'=>App::getLocale()]) }}">    {{ $tr::trans( $businessCategory->name , App::getLocale())}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="hover-nav li-inner">
                            <a>   {{ $tr::trans( 'خدماتنا' , App::getLocale())}} </a>
                            @if (isset($serviceCategories) and $serviceCategories != null)
                                <ul class="ul-inner">
                                    @foreach ($serviceCategories as $serviceCategory)
                                        <li class="li-inner-nav">
                                            <a class="a-inner-nav"
                                                href="{{ route('services', ['slug'=>$serviceCategory->slug ,'local'=>App::getLocale()]) }}">  {{ $tr::trans(  $serviceCategory->name  , App::getLocale())}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="hover-nav"><a href="{{ route('realestate',App::getLocale()) }}">    {{ $tr::trans(  '  مبيعات و تأجير '  , App::getLocale())}}</a></li>
                        <li class="hover-nav"><a href="{{ route('social-services',App::getLocale()) }}">    {{ $tr::trans(  '  الخدمة المجتمعية  '  , App::getLocale())}}</a></li>
                        <li class="hover-nav"><a href="{{ route('blog',App::getLocale()) }}">   {{ $tr::trans(  '  مدونة   '  , App::getLocale())}}</a></li>
                        <li class="hover-nav"><a href="{{ route('contact-us',App::getLocale()) }}">    {{ $tr::trans(  '  تواصل معنا  '  , App::getLocale())}}</a></li>
                    
                        <li class="hover-nav" style="margin-right: 10%;">
                            <a> {{ \LaravelLocalization::getCurrentLocaleName() }}</a>
                             <ul class="ul-inner">
                                 @foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                     <li class="li-inner-nav">
                                         <a class="a-inner-nav" rel="alternate" hreflang="{{ $localeCode }}" href="{{ str_replace(App::getLocale(), $localeCode, url()->current())  }}">
                                                 {{ $properties['native'] }}
                                         </a>
                                     </li>
                                 @endforeach
                             </ul>
                         </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
      </header>
      <!-- Header end here -->
