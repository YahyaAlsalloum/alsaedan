@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Apartment Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="apartment-details-form">save
                            </button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>

                            <button class="admin-form-close-btn" onclick="window.location.href='{{ route('realestate.edit', $villa->realestate_id) }}'">close</button>
                            
                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form id="apartment-details-form" method="POST"
                    action="{{ route('villa.update', $villa->_id) }}" class="form-horizontal form-label-left"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="clp">
                                <h5>
                                    Apartment Info
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="number">Apartment Number<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="number" name="number" required
                                                value="{{ $villa->number }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="space">Apartment Space<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="space" name="space" required
                                                value="{{ $villa->space }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="space">Number Of Rooms<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="number" id="rooms" name="rooms" required
                                                value="{{ $villa->rooms }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="space">Price<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="number" id="price" name="price" required
                                                value="{{ $villa->price }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->


                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Status<span class="required"
                                                style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax" id="status_id"
                                                data-route="{{ route('select.ajax', 'Status') }}" data-name="name"
                                                data-value="_id" onchange="ajaxSelect('status_id','Status')"
                                                name="status_id" required>
                                                @if (isset($villa->status))
                                                    <option value="{{ $villa->status->_id }}" selected>
                                                        {{ $villa->status->name }}</option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="villaStatus_id">Villa Status<span class="required"
                                                style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax" id="villaStatus_id"
                                                data-route="{{ route('select.ajax', 'ApartmentStatus') }}" data-name="name"
                                                data-value="_id" onchange="ajaxSelect('villaStatus_id','Villa Status')"
                                                name="villaStatus_id" required>
                                                @if (isset($villa->villaStatus_id))
                                                    <option value="{{ $villa->apartmentStatus->_id }}" selected>
                                                        {{ $villa->apartmentStatus->name }}</option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Realestate<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="hidden" id="realestate_id" name="realestate_id" required
                                                value="{{ $villa->realestate_id }}"  class="form-control col-12" />
                                            <input type="text"  required
                                                value="{{ $villa->realestate->name }}" readonly class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->



                                <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="image"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-image"
                                                src="{{ $villa->image != null ? asset($villa->image) : asset('img/logo-placeholder.png') }}"
                                                alt="" />
                                        </div>
                                        <label class="control-label col-12" for="image">Apartment Image Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">
                                            <input type="hidden" id="hidden_image" name="hidden_image"
                                                value="{{ $villa->image != null ? 1 : 0 }}" />

                                            <input type="file" id="image" name="image" value="{{ old('image') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1" for="image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                                <div class="col-lg-12 pr-md-12 pl-md-12 p-0 mt-md-12 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="description">Description</label>
                                        <div class="col-12">
                                            <textarea class="col-md-12 form post-text" name="description" maxlength="150">{!! $villa->description !!}</textarea>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->

                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Apartment Advantages
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="col-md-12 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                                    <div class="form-group">
                                        @include('cms.layouts.dynamic-inputs', [
                                            'add' => 'Add Apartment Advantage',
                                            'label' => 'Apartment Advantages',
                                            'hidden' => 'advantage',
                                            'inputs' => [
                                                [
                                                    'name' => 'advantage_names',
                                                    'type' => 'text',
                                                    'placeHolder' => 'Advantage Name',
                                                    'required' => true,
                                                ],
                           
                                                [
                                                    'name' => 'object_images',
                                                    'type' => 'image',
                                                    'id' => 'image',
                                                    'label' => 'icon',
                                                ],
                                            ],
                                            'values' => $villa->advantage_values,
                                        ])
                                    </div>
                                </div><!-- /.col-* -->
                            </div><!-- /.row.clpc -->
                        </div>
                

                    </div><!-- /.row -->
                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
        
    </div><!-- /.row -->
@endsection
@push('js')
    <script>
        CKEDITOR.replace('description');
        ajaxSelect('status_id', 'Status')
        // ajaxSelect('realestate_id', 'Realestate')
        ajaxSelect('villaStatus_id', 'Villa Status')

        $(function() {
            $('.select2-multiple').select2({
                width: '100%',
                multiple: true,
            });
        });

        function readURL(input, preview) {

            var id = input.id;
            document.getElementById('hidden_' + id).value = 1
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.show()
                    preview.attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function goBack() {
            window.history.back();
        }
    </script>


@endpush
