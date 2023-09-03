<div class="col-md-3 left_col menu_fixed p-0">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" >
            <a href="{{ route('dashboard') }}" class="site_title">
                <img src="{{asset('assets/images/logo.png')}}" alt="alsaedan" />
            </a>

        </div>
        <div class="clearfix"></div>
        <br/>
        @include('cms.layouts.sidebar')

    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu border-0" style="background: none">
        <nav>
            <div class="nav navbar-nav navbar-right" id="profile">
                <a style="margin-right: 10px;vertical-align: middle">{{auth()->user()->name}}</a>
                <i class="fas fa-user"></i>
            </div>
            <div class="nav navbar-nav navbar-right" id="settings" style="padding: 20px;">
                {{-- <i  class="fas fa-bell" onclick="window.location.href='{{route('notification.index')}}'" style="cursor:pointer;"></i>@if($notification_number>0)<span class="notification-span-number">{{$notification_number}}</span>@endif --}}


                    <i class="fas fa-power-off" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-left: 15px;cursor:pointer;color: white;"></i>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>

        </nav>
    </div>
</div>
<!-- /top navigation -->
