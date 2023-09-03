<!-- Footer start here -->
<footer id="footer">
    <div class="footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-4 col-sm-6 ">
                    <div class="footer-row">
                        <i><img src="{{ asset('assets/images/contactinfo-icon.png') }}" alt=""></i>
                        <h3> {{ $tr::trans('Contact Info', App::getLocale()) }}</h3>
                        <p>Phone: <a href="tel:{{ $setting->contact_phone }}">{{ $setting->contact_phone }}</a></p>
                        <p>Email: <a href="mailto:{{ $setting->contact_email }}">{{ $setting->contact_email }}</a></p>
                        <p>Web: <a href="https://{{ $setting->contact_website }}" target="_blanck">{{ $setting->contact_website }}</a></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 ">
                    <div class="footer-row">
                        <i><img src="{{ asset('assets/images/location-icon.png') }}" alt=""></i>
                        <h3> {{ $tr::trans('Location', App::getLocale()) }}</h3>
                        {!!  $tr::trans($setting->address, App::getLocale())  !!}
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 ">
                    <div class="footer-row">
                        <i><img src="{{ asset('assets/images/hours-icon.png') }}" alt=""></i>
                        <h3>{{ $tr::trans('Opening Hours' , App::getLocale()) }} 
                           </h3>
                     @php
                        echo  str_replace("< /p>", "",$tr::trans($setting->opening_hours , App::getLocale()));
                     @endphp 
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="socialmedia_links">
                        <p> {{ $tr::trans('  ابقى على توصل معنا', App::getLocale()) }} </p>
                        <ul>
                            @if (isset($setting->facebook) and $setting->facebook != null)
                                <li><a href="{{ $setting->facebook }}" target="_blanck"><img
                                            src="{{ asset('assets/images/fb.png') }}" alt=""></a></li>
                            @endif

                            @if (isset($setting->instagram) and $setting->instagram != null)
                                <li><a href="{{ $setting->instagram }}" target="_blanck"><img src="{{ asset('assets/images/insta.png') }}"
                                            alt=""></a></li>
                            @endif
                            @if (isset($setting->twitter) and $setting->twitter != null)
                                <li><a href="{{ $setting->twitter }}" target="_blanck"><img src="{{ asset('assets/images/twitter.png') }}"
                                            alt=""></a></li>
                            @endif
                            @if (isset($setting->linkedin) and $setting->linkedin != null)
                                <li><a href="{{ $setting->linkedin }}" target="_blanck"><img src="{{ asset('assets/images/linkedin.png') }}"
                                            alt=""></a></li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- Footer end here -->
