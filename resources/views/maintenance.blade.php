@extends('layouts.master')

@section('content')
    <main>

        <div class="maintenance-page">
            <div class="container">
                <div class="contact-page-title">
                    <h1>تقديم فرص إستثمارية</h1>
                </div>
                <div class="maintenance-form container">
                 
                    <div class="row">
                        
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <input type="text" id="company_name" name="" placeholder="اسم الجهة">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <input type="text" id="company_email" placeholder="البريد الإلكتروني للجهة">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <input type="text" id="name" placeholder="الاسم الكامل">
                            </div>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <input type="text" id="email" placeholder="البريد الإلكتروني">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <input type="text" id="phone_number" placeholder="رقم الهاتف ">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <select id="company_type" >
                                    <option value="">نوع الجهة </option>
                                    <option value="خاصة">خاصة  </option>
                                    <option value="حكومية">حكومية  </option>
                                </select>
                            </div>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <select id="maintenance_reason">
                                    <option value="">الغرض </option>
                                    <option value="شراء" >شراء  </option>
                                    <option value="استثمار">استثمار  </option>
                                    <option value="شراكة">شراكة  </option>
                                    <option value="تعاون">تعاون  </option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <input type="text" id="country" placeholder="الدولة ">
                            </div>
                        </div>
    
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <input type="text" id="city" placeholder="المدينة ">
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-sm-6">
                            <div class="input-row">
                                <select id="neighborhood" >
                                    <option value="">الحي </option>
                                    <option value="التعاون">التعاون </option>
                                    <option value="الربيع">الربيع </option>
                                    <option value="الرمال">الرمال </option>
                                    <option value="الروضة">الروضة </option>
                                    <option value="الريان">الريان </option>
                                    <option value="الصحافة">الصحافة </option>
                                    <option value="العارض">العارض </option>
                                    <option value="العقيق">العقيق </option>
                                    <option value="الغدير">الغدير </option>
                                    <option value="الفلاح">الفلاح </option>
                                    <option value="القيروان">القيروان </option>
                                    <option value="المغرزات">المغرزات </option>
                                    <option value="الملقا">الملقا </option>
                                    <option value="الندى">الندى </option>
                                    <option value="النرجس">النرجس </option>
                                    <option value="النفل">النفل </option>
                                    <option value="الوادي">الوادي </option>
                                    <option value="الياسمين">الياسمين </option>
                                    <option value="حطين">حطين </option>
                                    <option value="القادسية">القادسية </option>
                                    <option value="الرحاب">الرحاب </option>
                                    <option value="المروج">المروج </option>
                                    <option value="النخيل">النخيل </option>
                                    <option value="عرقة">عرقة </option>
                                    <option value="قرطبة">قرطبة </option>
                                    <option value="أخرى">أخرى ... </option>
                                </select>
                            </div>
                        </div>
                        
                    
                        <div class="col-md-12 col-sm-12">
                            <div class="input-row">
                                <textarea id="comment" placeholder="نبذه عن الشركة او المشروع"></textarea>
                            </div>
                        </div>
    
    
                        <div class="col-md-12 col-sm-12">
                            <div class="input-submit">
                                <input id="submit_maintenance" type="submit" onclick="return false;" value="إرسال">
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
            $("#submit_maintenance").on("click", function() {


                let company_name = $('#company_name').val();
                let company_email = $('#company_email').val();
                let company_type = $('#company_type').val();
                let country = $('#country').val();
                let city = $('#city').val();
                let neighborhood = $('#neighborhood').val();
                let maintenance_reason = $('#maintenance_reason').val();
                let email = $('#email').val();
                let phone_number = $('#phone_number').val();
                let name = $('#name').val();
                let comment = $('#comment').val();
                
             
                // console.log(apartmentStatus_id);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('submit.maintenance') }}',
                    data: {
                        email: email,
                        phone_number: phone_number,
                        name: name,
                        city: city,
                        comment: comment,
                        company_name: company_name,
                        company_email: company_email,
                        company_type: company_type,
                        country: country,
                        neighborhood: neighborhood,
                        maintenance_reason: maintenance_reason,
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
