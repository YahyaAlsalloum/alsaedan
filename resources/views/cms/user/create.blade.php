@extends('cms.layouts.app')

@section('content')
    <div class="row admin-form-container">
        <div class="col-12">

            <div class="page-title">
                <div class="title_left">
                    <h5><b style="color: black;">User</b></h5>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="artist-create-form">Submit</button>
                            <button class="admin-form-close-btn" onclick="resetPage()">reset</button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->
                <form id="artist-create-form" method="POST" action="{{route('user.store')}}"
                      class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="name">Name<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <input type="text" id="name" name="name" required value="{{old('name')}}"
                                           class="form-control col-12"/>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="email">Email<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <input type="email" id="email" name="email" required value="{{old('email')}}"
                                           class="form-control col-12"/>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="phone">Phone</label>
                                <div class="col-12">
                                    <input type="tel" id="phone" name="phone"  value="{{old('phone')}}"
                                           class="form-control col-12"/>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->


                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="status_id">Status<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <select class="select2 select2-ajax"
                                            name="status_id"
                                            id="status_id"
                                            data-route="{{route('select.ajax','Status')}}"
                                            data-name="name"
                                            data-value="_id"
                                            required>
                                        @if(old('status_id') != null)
                                            <option value="{{old('status_id')}}" selected>
                                                {{\App\Models\Status::find(old('status_id'))->name}}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="role_id">Role<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <select class="select2 select2-ajax"
                                            name="role_id"
                                            id="role_id"
                                            data-route="{{route('select.ajax','Role')}}"
                                            data-name="name"
                                            data-value="_id"
                                            required>
                                        @if(old('role_id') != null)
                                            <option value="{{old('role_id')}}" selected>
                                                {{\App\Models\Role::find(old('role_id'))->name}}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->


                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="bio">Bio (Max: 150)</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="bio" id="bio" rows="1"
                                              maxlength="150">{{old('bio')}}</textarea>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->
                        
                        <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0" style="min-height: 60px">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="image"><i class="fa fa-window-close"
                                    aria-hidden="true"></i></a>
                                    <img class="image-display" id="src-image"
                                            src="{{asset('img/logo-placeholder.png')}}"
                                            alt=""/>
                                    </div>
                                <label class="control-label col-12">Photo (800 x 800 px)</label>
                                <div class="control-image-field col-12 d-flex flex-row">
                                    
                                    <input type="hidden" id="hidden_image" 
                                    name="hidden_image"  
                                    value="{{0}}"/>
                                    <input type="file" id="image" name="image" onchange="readURL(this,$(this).parent().parent().find('.image-display'));" class="input-file d-none"/>
                                    <span class="file-input-name-preview col-8"> </span>
                                    <label class="upload-file-label col-3 offset-1" for="image">Upload</label>
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
    <script>
        ajaxSelect('status_id', 'Status', 'slug=active,in-active')
        ajaxSelect('role_id', 'Role', 'slug=admin,business-owner,user')
    </script>

    <script type='text/javascript'>

        ;(function () {
            var inputs = document.querySelectorAll('.input-file');

            Array.prototype.forEach.call(inputs, function (input) {
                var span = input.nextElementSibling;

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

        function preview_image(event, imageHolderId) {
            var reader = new FileReader();

            reader.onload = function () {
                var output = document.getElementById(imageHolderId);
                output.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }

        function addFile() {
            let counter = parseInt(Math.random() * 1000);
            let div = '<div class="row" style="margin-bottom:20px">' +
                ' <div class="col-3"><input type="text" name="other_files_names[\'' + counter + '\']" required  placeholder="name" class="form-control col-12"/></div>' +
                '   <input type="file" id="other_files[\'' + counter + '\']" name="other_files[\'' + counter + '\']"  class="input-file d-none" required/>' +
                '   <span class="file-input-name-preview col-4"> </span>' +
                '   <label class="upload-file-label col-2" for="other_files[\'' + counter + '\']">Upload</label>' +
                '   <div class="col-3"><div class="btn btn-danger float-right" onClick="$(this).parent().parent().remove()">remove</div></div>' +
                '  </div>'
            $('#files-box').append(div);

            var input = document.getElementById('other_files[\'' + counter + '\']')
            var span = input.nextElementSibling;

            input.addEventListener('change', function (e) {
                var fileName = e.target.value.split('\\').pop();
                if (fileName)
                    span.innerHTML = fileName;
            });
            input.addEventListener('focus', function () {
                input.classList.add('has-focus');
            });
            input.addEventListener('blur', function () {
                input.classList.remove('has-focus');
            });
        }

        function goBack() {
            window.history.back();
        }
    </script>
@endpush
