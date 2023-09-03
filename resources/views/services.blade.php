@extends('layouts.master')

@section('content')
    <main>
        <div class="services-page">
            <div class="services-page-top">
                <div class="container">
                    <div class="service-slider">
                        @foreach ($serviceCategories as $indexKey => $category)
                            <div class="services-page-row" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                                <p>{{ $indexKey + 1 }}/<sub>{{ $loop->count + 1 }}</sub>
                                    <span> <a class="white-a"
                                            href="  {{ route('services', ['slug'=> $category->slug, 'local'=>App::getLocale()]) }}">  {{ $tr::trans(  $category->name  , App::getLocale())}}</a></span>
                                </p>
                                <h1>   {{ $tr::trans(  $serviceCategory->name  , App::getLocale())}}</h1>
                            </div>
                        @endforeach
                    </div>
                    <div class="services-intro-text" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                        {!!    $tr::trans(  $serviceCategory->description  , App::getLocale()) !!}
                    </div>
                </div>
            </div>
            <div class="services-slider-section">
                <div class="tab-menu">
                    <ul>
                        @foreach ($serviceCategory->services() as $service)
                            <li>
                                <a href="JavaScript:void(0);"
                                    class="tab-a @if (isset($activeService) and $activeService != null) @if($activeService == $service->_id) active-a @endif @elseif($loop->first)active-a @endif"
                                    data-id="{{ $service->_id }}">
                                    <i><img src="{{ asset($service->icon) }}"></i>
                                    <p>  {{ $tr::trans( $service->name  , App::getLocale())}}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @foreach ($serviceCategory->services() as $service)
                    <div class="tab @if (isset($activeService) and $activeService != null) @if($activeService == $service->_id) tab-active @endif @elseif($loop->first) tab-active @endif"
                        data-id="{{ $service->_id }}">
                        <div class="services-slider-item">
                            <img src="{{ asset($service->image) }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @foreach ($serviceCategory->services() as $service)
            <div class="tab @if (isset($activeService) and $activeService != null) @if($activeService == $service->_id) tab-active @endif @elseif($loop->first)tab-active @endif"
                data-id="{{ $service->_id }}">
                <div class="services-intro">
                    <div class="container">
                        <h2> {{ $tr::trans( $service->name  , App::getLocale())}}</h2>
                        <div>{!!  $tr::trans( $service->description  , App::getLocale()) !!} </div>
                    </div>
                </div>
            </div>
        @endforeach



        <!-- Our services classified -->
        <section class="services-classified-section">
            <p class="classified-title">   {{ $tr::trans( 'خدماتنا المصنفة من الهئية العامة للعقار   ' , App::getLocale())}}</p>
            <div class="container">
                <ul class="classified-list">
                    @foreach ($services as $service)
                        @if (isset($service->logo) and $service->logo != null)
                            <li>
                                <i><img src="{{ asset($service->logo) }}" alt=""></i>
                                <h3>   {{ $tr::trans( $service->name  , App::getLocale())}}</h3>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </section>

        <div class="maintenance-form container">
            <div class="form-page-title">
                <h1> {{ $tr::trans( 'تقديم طلب خدمة   ' , App::getLocale())}}</h1>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="input-row">
                        <input type="text" name="" placeholder=" {{ $tr::trans( 'البريد الإلكتروني ' , App::getLocale())}}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="input-row">
                        <input type="text" name="" placeholder="   {{ $tr::trans( ' رقم الهاتف     ' , App::getLocale())}}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="input-row">
                        <input type="text" name="" placeholder=" {{ $tr::trans( 'الاسم الكامل    ' , App::getLocale())}} ">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="input-row">
                        <input type="text" name="" placeholder="{{ $tr::trans( ' المبني ' , App::getLocale())}}">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="input-row">
                        <input type="text" name="" placeholder="">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="input-row">
                        <select>
                            <option> {{ $tr::trans( 'المشروع' , App::getLocale())}}</option>
                        </select>
                    </div>
                </div>


                {{-- <div class="col-md-12">
                    <div class="maintenance_check">
                        <div class="checkedrow">
                            <label class="maintenancecheck">عالية
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkedrow">
                            <label class="maintenancecheck">حالة طارئة
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkedrow">
                            <label class="maintenancecheck">حالة عادية
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <p class="OrderRating">:تصنيف الطلب</p>
                    </div>
                </div> --}}

                <div class="col-md-12 col-sm-12">
                    <div class="input-row">
                        <textarea placeholder=" {{ $tr::trans( ' وصف الحالة' , App::getLocale())}} ">

          </textarea>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="Download-attach">
                        <button class="Download-btn">  {{ $tr::trans( 'تحميل ملفات' , App::getLocale())}}</button>
                        <div class="file_attach">
                            <span>    {{ $tr::trans( 'يمكنك ارفاق الملفات  ' , App::getLocale())}}</span>
                            <input type="file" name="">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="input-submit">
                        <input type="submit" name="" value="{{ $tr::trans( 'إرسال' , App::getLocale())}}">
                    </div>
                </div>

            </div>
        </div>

        </div>
    </main>
@endsection
@push('js')
    <script type="text/javascript">
        $('.tab-a').click(function() {
            $(".deem-hero").addClass('hidden');
            $(".tab").removeClass('tab-active');
            $(".tab[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
            $(".tab-a").removeClass('active-a');
            $(this).parent().find(".tab-a").addClass('active-a');
        });
    </script>
@endpush
