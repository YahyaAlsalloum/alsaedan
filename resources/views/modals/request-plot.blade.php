<div id="plotRequest-{{ $plot->_id }}" class="modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-new" style="background-color: {{ $realestate->main_color }};">
                <h1 class="modal-title modal-tile-new">إختار وسيلة التواصل لحجز الوحدة
                    قطعة ({{ $plot->number }})   

                    ({{ $plot->number }})-({{ $plot->apartmentStatus->name }})</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-padding" id="plotForm-{{ $plot->_id }}" >
                    {{-- @csrf --}}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">الاسم الكامل</label>
                                <input type="text" class="form-control class-input-form" name="name" id="pl_name-{{ $plot->_id }}" style="border-color: {{ $realestate->secondary_color }};"
                                value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">رقم الجوال</label>
                                <input type="text" class="form-control  class-input-form" name="phone" id="pl_phone-{{ $plot->_id }}" style="border-color: {{ $realestate->secondary_color }};" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input  type="hidden" class="form-control class-input-form" id="pl_plot_id-{{ $plot->_id }}" value="{{ $plot->_id }}" required>
                            </div>
                            <div class="col-md-12">
                                <input  type="hidden" class="form-control class-input-form" id="pl_land_id-{{ $plot->_id }}" value="{{ $plot->land->_id }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="class-label-form"> البريد الالكتروني</label>
                                <input type="text" class="form-control class-input-form" name="email" id="pl_email-{{ $plot->_id }}" style="border-color: {{ $realestate->secondary_color }};" value="" required>
                            </div>
                        </div>
                       
                       
                        <input  type="hidden" class="form-control" id="pl_realestate_id-{{ $plot->_id }}" value="{{ $plot->land->realestate->_id }}" required>
                        
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="class-label-form">طريقة الدفع</label>
                                
                                    <select class="form-control class-input-form" name="payment" id="pl_payment-{{ $plot->_id }}"  style="border-color: {{ $realestate->secondary_color }};">
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
                            
                            <input  class="submitPlotForm button-send-form btn" data-id="{{ $plot->_id }}" style="background-color: {{ $realestate->secondary_color }};" value="إرسال" readonly>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
