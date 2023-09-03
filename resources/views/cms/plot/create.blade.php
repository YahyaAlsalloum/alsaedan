@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Plot Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="plot-details-form-store">submit</button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>
                            <button class="admin-form-close-btn" onclick="window.location.href='{{ route('land.edit', $land_id) }}'">close</button>

                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form method="POST" id="plot-details-form-store" action="{{route('plot.store')}}" class="form-horizontal form-label-left"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Overview
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                
                                <hr class="rounded form-horizontal-line">
                            </div>
                            <div class="row clpc active" style="display: block;">
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="number">Plot Number<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="number" name="number" required value="{{old('number')}}"
                                                   class="form-control col-12"/>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="space">Plot Space<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="space" name="space" required value="{{old('space')}}"
                                                   class="form-control col-12"/>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                  
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="price">Price<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="number" id="price" name="price" required value="{{old('price')}}"
                                                   class="form-control col-12"/>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                  
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Status<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax"
                                                    id="status_id"
                                                    data-route="{{route('select.ajax','Status')}}"
                                                    data-name="name"
                                                    data-value="_id"
                                                    onchange="ajaxSelect('status_id','Status')"
                                                    name="status_id"
                                                    required>
                                                @if(old('status_id') != null)
                                                    <option value="{{old('status_id')}}" selected>
                                                        {{\App\Models\Status::find(old('status_id'))->name}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="apartmentStatus_id">Plot Status<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax"
                                                    id="apartmentStatus_id"
                                                    data-route="{{route('select.ajax','ApartmentStatus')}}"
                                                    data-name="name"
                                                    data-value="_id"
                                                    onchange="ajaxSelect('apartmentStatus_id','ApartmentStatus')"
                                                    name="apartmentStatus_id"
                                                    required>
                                                @if(old('apartmentStatus_id') != null)
                                                    <option value="{{old('apartmentStatus_id')}}" selected>
                                                        {{\App\Models\ApartmentStatus::find(old('apartmentStatus_id'))->name}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                @if (isset($land_id) and $land_id != null)
                                <input type="text" hidden id="land_id" name="land_id" required readonly
                                    value="{{ $land_id }}" class="form-control col-12" />
                                @else
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="land_id">Floor<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax"
                                                    id="land_id"
                                                    data-route="{{route('select.ajax','Floor')}}"
                                                    data-name="name"
                                                    data-value="_id"
                                                    onchange="ajaxSelect('land_id','Floor')"
                                                    name="land_id"
                                                    required>
                                                @if(old('land_id') != null)
                                                    <option value="{{old('land_id')}}" selected>
                                                        {{\App\Models\Floor::find(old('land_id'))->name}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                @endif
                                <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                            style="position:absolute;" data-id="image"><i class="fa fa-window-close"
                                            aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-image"
                                                    src="{{asset('img/logo-placeholder.png')}}"
                                                    alt=""/>
                                        </div>
                                        <label class="control-label col-12" for="image">Plot Image Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">
                                            
                                            <input type="hidden" id="hidden_image" 
                                            name="hidden_image"  
                                            value="{{0}}"/>
                                            <input type="file" id="image" name="image" value="{{old('image')}}"
                                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                    class="input-file d-none"/>
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1"
                                                    for="image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                                
                                <div class="col-lg-12 pr-md-12 pl-md-12 p-0 mt-md-12 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="description">description</label>
                                        <div class="col-12">
                                            <textarea class="col-md-12 form post-text" name="description"></textarea>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                            </div><!-- /.row -->
                        </div><!-- /.col-* -->
                        
                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Plot Advantages
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
                                            'add' => 'Add Plot Advantage',
                                            'label' => 'Plot Advantages',
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
        ajaxSelect('status_id', 'Status', 'slug=in-active,active')
        // ajaxSelect('land_id', 'Floor')
        ajaxSelect('apartmentStatus_id', 'Plot Status')
    </script>
    

    
<script>
    var toggler = document.getElementsByClassName("reference-tab");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".reference-nested").classList.toggle("nested-active");
            this.querySelector('.fa').classList.toggle("fa-plus");
            this.querySelector('.fa').classList.toggle("fa-minus");
        });
    }
</script>

@endpush
