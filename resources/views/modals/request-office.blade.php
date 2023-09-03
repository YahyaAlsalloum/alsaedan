<div id="officeRequest-{{ $office->_id }}" class="modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-new" style="background-color: {{ $realestate->main_color }};">
                <h1 class="modal-title modal-tile-new">إختار وسيلة التواصل لحجز الوحدة
                    مكتب ({{ $office->number }})

                    ({{ $office->number }})-({{ $office->apartmentStatus->name }})</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-padding" id="officeForm-{{ $office->_id }}">
                    {{-- @csrf --}}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">الاسم الكامل</label>
                                <input type="text" class="form-control class-input-form" name="name"
                                    id="of_name-{{ $office->_id }}"
                                    style="border-color: {{ $realestate->secondary_color }};" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">رقم الجوال</label>
                                <input type="text" class="form-control  class-input-form" name="phone"
                                    id="of_phone-{{ $office->_id }}" value=""
                                    style="border-color: {{ $realestate->secondary_color }};" required>
                            </div>
                        </div>
                    </div>
                    {{-- @dd($office->) --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control class-input-form"
                                    id="of_office_id-{{ $office->_id }}" value="{{ $office->_id }}" required>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" class="form-control class-input-form"
                                    id="of_floor_id-{{ $office->_id }}" value="{{ $office->showroom->_id }}"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <label class="class-label-form"> البريد الالكتروني</label>
                                <input type="text" class="form-control class-input-form" name="email"
                                    id="of_email-{{ $office->_id }}"
                                    style="border-color: {{ $realestate->secondary_color }};" value="" required>
                            </div>

                        </div>


                        <input type="hidden" class="form-control" id="of_realestate_id-{{ $office->_id }}"
                            value="{{ $office->showroom->realestate->_id }}" required>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">طريقة الدفع</label>
                                
                                    <select class="form-control class-input-form" id="office_payment-{{ $office->_id }}" style="border-color: {{ $realestate->secondary_color }};">
                                        <option value="كاش">كاش </option>
                                        <option value="جهة تمويلية">جهة تمويلية  </option>
                                    </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">إقرار بسماح الاستعلام في سمه عن اهليه العميل للشراء</label>
                                <input type="checkbox" class="form-control  class-input-form" 
                                    style="border-color: {{ $realestate->secondary_color }};width: unset;display: inline-block;" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 text-center padding-top-form">

                            <input class="submitOfficeForm button-send-form btn" data-id="{{ $office->_id }}"
                                style="background-color: {{ $realestate->secondary_color }};" value="إرسال" readonly>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
