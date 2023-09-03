@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        About Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="about-details-form">save
                            </button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>


                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form id="about-details-form" method="POST" action="{{ route('about.update', $about->_id) }}"
                    class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row pt-5">
                        <div class="col-12">
                            <div class="clp">
                                <h5>
                                    About Info
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="row">
                                    <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="about_us">About us</label>
                                            <div class="col-12">
                                                <textarea class="col-md-12 form post-text" name="about_us" maxlength="150">{!! $about->about_us !!}</textarea>
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                    <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                        <div class="form-group">
                                            <div class="col-md-12">

                                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                    style="position:absolute;" data-id="about_image"><i
                                                        class="fa fa-window-close" aria-hidden="true"></i></a>
                                                <img class="image-display" id="src-about_image"
                                                    src="{{ $about->about_image != null ? asset($about->about_image) : asset('img/logo-placeholder.png') }}"
                                                    alt="" />
                                            </div>
                                            <label class="control-label col-12" for="about_image">About Image </label>
                                            <div class="control-image-field col-12 d-flex flex-row">
                                                <input type="hidden" id="hidden_about_image" name="hidden_about_image"
                                                    value="{{ $about->about_image != null ? 1 : 0 }}" />

                                                <input type="file" id="about_image" name="about_image"
                                                    value="{{ old('about_image') }}"
                                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                    class="input-file d-none" />
                                                <span class="file-input-name-preview col-8"> </span>
                                                <label class="upload-file-label col-3 offset-1"
                                                    for="about_image">Upload</label>
                                            </div>
                                        </div>
                                    </div><!-- /.col-* -->
                                </div>





                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->



                    </div><!-- /.row -->
                    <div class="row pt-5">

                        <div class="col-12">
                            <div class="clp">
                                <h5>
                                    Vision Info
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">

                                <div class="row">
                                    <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="our_vision">Our vision</label>
                                            <div class="col-12">
                                                <textarea class="col-md-12 form post-text" name="our_vision" maxlength="150">{!! $about->our_vision !!}</textarea>
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                    <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="our_message">Our message</label>
                                            <div class="col-12">
                                                <textarea class="col-md-12 form post-text" name="our_message" maxlength="150">{!! $about->our_message !!}</textarea>
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                    <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                        <div class="form-group">
                                            <div class="col-md-12">

                                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                    style="position:absolute;" data-id="vision_image"><i
                                                        class="fa fa-window-close" aria-hidden="true"></i></a>
                                                <img class="image-display" id="src-vision_image"
                                                    src="{{ $about->vision_image != null ? asset($about->vision_image) : asset('img/logo-placeholder.png') }}"
                                                    alt="" />
                                            </div>
                                            <label class="control-label col-12" for="vision_image">Vision Image </label>
                                            <div class="control-image-field col-12 d-flex flex-row">
                                                <input type="hidden" id="hidden_vision_image" name="hidden_vision_image"
                                                    value="{{ $about->vision_image != null ? 1 : 0 }}" />

                                                <input type="file" id="vision_image" name="vision_image"
                                                    value="{{ old('vision_image') }}"
                                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                    class="input-file d-none" />
                                                <span class="file-input-name-preview col-8"> </span>
                                                <label class="upload-file-label col-3 offset-1"
                                                    for="vision_image">Upload</label>
                                            </div>
                                        </div>
                                    </div><!-- /.col-* -->
                                </div>

                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->

                    </div>
                    <div class="row pt-5">

                        <div class="col-12">
                            <div class="clp">
                                <h5>
                                    Our Identity Info
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">

                                <div class="row">
                                    <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="our_identity">Our identity</label>
                                            <div class="col-12">
                                                <textarea class="col-md-12 form post-text" name="our_identity" maxlength="150">{!! $about->our_identity !!}</textarea>
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                    <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                        <div class="form-group">
                                            <div class="col-md-12">

                                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                    style="position:absolute;" data-id="identity_image"><i
                                                        class="fa fa-window-close" aria-hidden="true"></i></a>
                                                <img class="image-display" id="src-identity_image"
                                                    src="{{ $about->identity_image != null ? asset($about->identity_image) : asset('img/logo-placeholder.png') }}"
                                                    alt="" />
                                            </div>
                                            <label class="control-label col-12" for="identity_image">identity Image </label>
                                            <div class="control-image-field col-12 d-flex flex-row">
                                                <input type="hidden" id="hidden_identity_image" name="hidden_identity_image"
                                                    value="{{ $about->identity_image != null ? 1 : 0 }}" />

                                                <input type="file" id="identity_image" name="identity_image"
                                                    value="{{ old('identity_image') }}"
                                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                    class="input-file d-none" />
                                                <span class="file-input-name-preview col-8"> </span>
                                                <label class="upload-file-label col-3 offset-1"
                                                    for="identity_image">Upload</label>
                                            </div>
                                        </div>
                                    </div><!-- /.col-* -->
                                </div>

                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->

                    </div>
                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    <script>
        CKEDITOR.replace('about_us');
        CKEDITOR.replace('our_vision');
        CKEDITOR.replace('our_message');
        CKEDITOR.replace('our_identity');

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
    </script>
@endpush
