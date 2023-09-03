@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Building Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit"
                                form="building-details-form-store">submit</button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>
                            <button class="admin-form-close-btn" onclick="window.location.href='{{  route('realestate.edit', $realestate_id)}}'">close</button>

                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form method="POST" id="building-details-form-store" action="{{ route('building.store') }}"
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
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Building Name<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="name" name="name" required
                                                value="{{ old('name') }}" class="form-control col-12" />
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
                                                @if (old('status_id') != null)
                                                    <option value="{{ old('status_id') }}" selected>
                                                        {{ \App\Models\Status::find(old('status_id'))->name }}
                                                    </option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                @if (isset($realestate_id) and $realestate_id != null)
                                    <input type="text" hidden id="realestate_id" name="realestate_id" required readonly
                                        value="{{ $realestate_id }}" class="form-control col-12" />
                                @else
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="realestate_id">Realestate<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <select class="select2 select2-ajax" id="realestate_id"
                                                    data-route="{{ route('select.ajax', 'Realestate') }}" data-name="name"
                                                    data-value="_id" onchange="ajaxSelect('realestate_id','Realestate')"
                                                    name="realestate_id" required>
                                                    @if (old('realestate_id') != null)
                                                        <option value="{{ old('realestate_id') }}" selected>
                                                            {{ \App\Models\Realestate::find(old('realestate_id'))->name }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                @endif
                                {{-- <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="logo"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-logo"
                                                src="{{ asset('img/logo-placeholder.png') }}" alt="" />
                                        </div>
                                        <label class="control-label col-12" for="logo">Building Logo Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">

                                            <input type="hidden" id="hidden_logo" name="hidden_logo"
                                                value="{{ 0 }}" />
                                            <input type="file" id="logo" name="logo" value="{{ old('logo') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1" for="logo">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* --> --}}
                                {{-- <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="cover_image"><i
                                                    class="fa fa-window-close" aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-cover_image"
                                                src="{{ asset('img/logo-placeholder.png') }}" alt="" />
                                        </div>
                                        <label class="control-label col-12" for="cover_image">Building Cover Photo (
                                            900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">

                                            <input type="hidden" id="hidden_cover_image" name="hidden_cover_image"
                                                value="{{ 0 }}" />
                                            <input type="file" id="cover_image" name="cover_image"
                                                value="{{ old('cover_image') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1"
                                                for="cover_image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* --> --}}

                                {{-- <div class="col-lg-12 pr-md-12 pl-md-12 p-0 mt-md-12 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="description">description</label>
                                        <div class="col-12">
                                            <textarea class="col-md-12 form post-text" name="description"></textarea>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* --> --}}
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
        ajaxSelect('realestate_id', 'Realestate')

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
