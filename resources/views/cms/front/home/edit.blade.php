@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Home</h5>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="home-edit-form">save</button>
                            <button class="admin-form-close-btn" onclick="goBack()">close</button>
                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form method="POST" id="home-edit-form" action="{{route('home.update',$home->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-12 col-xs-12" for="title">
                                    Title
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <input type="text" id="title" name="title" required
                                           value="{{$home->title}}" class="form-control col-md-12 col-xs-12 "/>
                                </div><!-- /.col-* -->
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-12 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-12" for="body">Body
                                    <span class="required" style="color:red">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <textarea class="form-control editor" name="body" id="body" required="true"> {{$home->body}}</textarea>
                                </div>
                            </div>
                        </div><!-- /.col-* -->



                        <div class="col-lg-10 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="cover_image"><i class="fa fa-window-close"
                                    aria-hidden="true"></i></a>
                                    <img class="image-display"  id="src-cover_image" src="@isset($home->cover_image){{asset('storage/'.$home->cover_image)}}@else{{asset('img/logo-placeholder.png')}}@endisset" alt=""/>
                                </div>
                                <label class="control-label col-12" for="cover_image">Cover Image</label>
                                <div class="control-image-field col-12 d-flex flex-row">
                                    
                                    <input type="hidden" id="hidden_cover_image" 
                                    name="hidden_cover_image"  
                                    value="{{$home->cover_image  != null ? 1 : 0}}"/>
                                    <input type="file" id="cover_image" name="cover_image"  value="{{old('cover_image')}}"   onchange="readURL(this,$(this).parent().parent().find('.image-display'));" class="input-file d-none"/>
                                    <span class="file-input-name-preview col-8"> </span>
                                    <label class="upload-file-label col-3 offset-1" for="cover_image">Upload</label>
                                </div>
                            </div><!-- /.form-group -->
                        </div>




                        <div class="col-lg-6 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="appStore">App Store</label>
                                <div class="col-12">
                                    <input type="text" id="appStore" name="appStore" required
                                           value="{{$home->appStore}}" class="form-control col-12"/>
                                </div><!-- /.col-* -->
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->
                        <div class="col-lg-6 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="googlePlay">Google Play</label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <input type="text" id="googlePlay" name="googlePlay" required
                                           value="{{$home->googlePlay}}" class="form-control col-12"/>
                                </div><!-- /.col-* -->
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                    </div><!-- /.row -->

                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script type='text/javascript'>


        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('image-holder');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        ClassicEditor
            .create(document.querySelector('.editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });


        ;(function () {
            var inputs = document.querySelectorAll('.input-file');
            Array.prototype.forEach.call(inputs, function (input) {
                var span = input.nextElementSibling
                input.addEventListener('change', function (e) {
                    fileName = e.target.value.split('\\').pop();
                    if (fileName)
                        span.innerHTML = fileName;
                });
                input.addEventListener('focus', function () {
                    input.classList.add('has-focus');
                });
                input.addEventListener('blur', function () {
                    input.classList.remove('has-focus');
                });
            });
        })();

        function readURL(input, preview) {
            
            var id = input.id;
            document.getElementById('hidden_'+id).value = 1
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
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
