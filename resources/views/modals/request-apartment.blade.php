<div id="apartmentRequest-{{ $apartment->_id }}" class="modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-new" style="background:{{$realestate->main_color}} ">
                <h1 class="modal-title modal-tile-new">إختار وسيلة التواصل لحجز الوحدة
                    الدور ({{ $apartment->floor->name }}) شقة

                    ({{ $apartment->number }})-({{ $apartment->apartmentStatus->name }})</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-padding" id="apartmentForm-{{ $apartment->_id }}" >
                    {{-- @csrf --}}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">الاسم الكامل</label>
                                <input type="text" class="form-control class-input-form" name="name" id="ar_name-{{ $apartment->_id }}" style="border-color: {{ $realestate->secondary_color }};"
                                value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">رقم الجوال</label>
                                <input type="text" class="form-control  class-input-form" name="phone" id="ar_phone-{{ $apartment->_id }}" value="" style="border-color: {{ $realestate->secondary_color }};" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input  type="hidden" class="form-control class-input-form" id="ar_apartment_id-{{ $apartment->_id }}" value="{{ $apartment->_id }}" required>
                            </div>
                            <div class="col-md-12">
                                <input  type="hidden" class="form-control class-input-form" id="ar_floor_id-{{ $apartment->_id }}" value="{{ $apartment->floor->_id }}" required>
                            </div>
                            <div class="col-md-12">
                                <input  type="hidden" class="form-control class-input-form" id="ar_building_id-{{ $apartment->_id }}" value="{{ $apartment->floor->building->_id }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="class-label-form"> البريد الالكتروني</label>
                                <input type="text" class="form-control class-input-form" name="email" id="ar_email-{{ $apartment->_id }}" style="border-color: {{ $realestate->secondary_color }};" value="" required>
                            </div>
                        </div>
                       
                       
                        <input  type="hidden" class="form-control" id="ar_realestate_id-{{ $apartment->_id }}" value="{{ $apartment->floor->building->realestate->_id }}" required>
                        
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">طريقة الدفع</label>
                                
                                    <select class="form-control class-input-form" name="payment" id="ar_payment-{{ $apartment->_id }}" style="border-color: {{ $realestate->secondary_color }};">
                                        <option value="">كاش </option>
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
                            
                            <input  class="submitApartmentForm button-send-form btn" data-id="{{ $apartment->_id }}" style="background-color: {{ $realestate->secondary_color }};" value="إرسال" readonly>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
