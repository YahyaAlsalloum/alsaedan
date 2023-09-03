@extends('layouts.master')

@section('content')
    <main>

        <div class="contact-page">
            <div class="container">
                <div class="contact-page-title">
                    <h1>  {{ $tr::trans( 'تواصل معنا ', App::getLocale()) }}</h1>
                </div>
            </div>

            <div class="contact-map">
                <iframe
                    src="https://maps.google.com/maps?q={{ $setting->location[0] }},{{ $setting->location[1] }}&output=embed"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="contact-info">
                <div class="container">
                    <div class="row">
                        @foreach ($locations as $location)
                            <div class="col-md-4 col-sm-6">
                                <div class="contact-info-row">
                                    <i class="contact-icon"><img src="{{ $location->icon }}" alt=""></i>
                                    <div>
                                        <h2> {{ $tr::trans( $location->name , App::getLocale())}}</h2>
                                        <ul>
                                            <li><i><img src="{{ asset('assets/images/phone-icon.png') }}"
                                                        alt=""></i> {{ $tr::trans( ' رقم الهاتف:  ', App::getLocale()) }}<a href="tel:{{ $location->phone_number }}"> {{ $location->phone_number }}</a> </li>
                                            <li><i><img src="{{ asset('assets/images/phone-icon.png') }}"
                                                        alt=""></i>{{ $tr::trans( 'تحويلة:  ', App::getLocale()) }} {{ $location->transfer }}</li>
                                            <li><i><img src="{{ asset('assets/images/mail-icon.png') }}"
                                                        alt=""></i><a href="mailto:{{ $location->email }}">{{ $location->email }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="contact-form">
                <div class="container">
                    <div class="contact-form-row">
                        <div class="contact-form-top">
                            <h3>  {{ $tr::trans( 'تواصل معنا ', App::getLocale()) }} </h3>
                            <p>   {{ $tr::trans( ' فضلاً املأ الحقول الآتية بالبيانات اللازمة:  ', App::getLocale()) }}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="input-row">
                                    <input type="text" id="email" required placeholder=" {{ $tr::trans( 'البريد الإلكتروني ' , App::getLocale())}} ">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="input-row">
                                    <input type="text" id="phone_number" required placeholder="   {{ $tr::trans( 'رقم الهاتف ' , App::getLocale())}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="input-row">
                                    <input type="text" id="name" required placeholder="  {{ $tr::trans( 'الاسم الكامل    ' , App::getLocale())}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="input-row">
                                    <textarea id="comment" required placeholder=" {{ $tr::trans( 'تعليقك' , App::getLocale())}}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="input-submit">
                                    <input type="submit" id="send_contact" onclick="return false;" name="" value="{{ $tr::trans( 'إرسال' , App::getLocale())}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main>
@endsection
@push("js")
    <script>
    $(function() {
            $("#send_contact").on("click", function() {


               
                let email = $('#email').val();
                let phone_number = $('#phone_number').val();
                let name = $('#name').val();
                let comment = $('#comment').val();
                
             
                // console.log(apartmentStatus_id);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('submit.contact') }}',
                    data: {
                        email: email,
                        phone_number: phone_number,
                        name: name,
                        comment: comment,
                     
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.message !=null) {
                                toastr.success(data.message);
                                toastr.options =
                            {
                                "timeOut" : 1000
                            }
                        }
                    },
                    error: function(data) {}
                });
            });
        })
    </script>
@endpush
