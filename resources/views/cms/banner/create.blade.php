@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Banner Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="banner-details-form-store">submit</button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>

                            <button class="admin-form-close-btn"
                                onclick="window.location.href='{{ route('banner.index') }}'">close</button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form method="POST" id="banner-details-form-store" action="{{ route('banner.store') }}"
                    class="form-horizontal form-label-left" enctype="multipart/form-data">
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

                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Banner Name<span class="required"
                                                style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="name" name="name" required
                                                value="{{ old('name') }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Banner Slogan</label>
                                        <div class="col-12">
                                            <input type="text" id="slogan" name="slogan"
                                                value="{{ old('slogan') }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Status<span class="required"
                                                style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax" id="status_id"
                                                data-route="{{ route('select.ajax', 'Status') }}" data-name="name"
                                                data-value="_id" onchange="ajaxSelect('status_id','Status')"
                                                name="status_id" required>
                                                @if (old('status_id') != null)
                                                    <option value="{{ old('status_id') }}" selected>
                                                        {{ \App\Models\Status::find(old('status_id'))->name }}
                                                    </option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="location">Location<span class="required"
                                                style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-without-ajax-single" name="location"
                                                id="location" >
                                                    <option value="">Location</option>
                                                    <option value="home-page">Home Page</option>
                                                    <option value="business-page">Business Page</option>
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                {{-- <div class="col-lg-12 pr-md-12 pl-md-12 p-0 mt-md-12 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="description">description</label>
                                        <div class="col-12">
                                            <textarea class="col-md-12 form post-text" name="description"></textarea>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* --> --}}


                                <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="image"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-image"
                                                src="{{ asset('img/logo-placeholder.png') }}" alt="" />
                                        </div>
                                        <label class="control-label col-12" for="image">Banner Image Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">

                                            <input type="hidden" id="hidden_image" name="hidden_image"
                                                value="{{ 0 }}" />
                                            <input type="file" id="image" name="image" value="{{ old('image') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1" for="image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                            </div><!-- /.row -->
                        </div><!-- /.col-* -->

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
