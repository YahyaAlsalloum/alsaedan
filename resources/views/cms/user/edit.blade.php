@extends('cms.layouts.app')
@push('css')
    <style>
        [type="file"] {
            height: 0;
            overflow: hidden;
            width: 0;
        }

        [type="file"] + label {
            background: #f15d22;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: 'Poppins', sans-serif;
            font-size: inherit;
            font-weight: 600;
            margin-bottom: 1rem;
            outline: none;
            padding: 1rem 50px;
            position: relative;
            transition: all 0.3s;
            vertical-align: middle;
        }

        [type="file"] + label:hover {
            background-color: #d3460d;
        }

        [type="file"] + label.btn-2 {
            background-color: #99c793;
            border-radius: 50px;
            overflow: hidden;
        }

        [type="file"] + label.btn-2::before {
            color: #fff;
            content: "\f0ee";
            font-family: "FontAwesome";
            font-size: 100%;
            height: 100%;
            right: 130%;
            line-height: 3.3;
            position: absolute;
            top: 0px;
            transition: all 0.3s;
        }

        [type="file"] + label.btn-2:hover {
            background-color: #497f42;
        }

        [type="file"] + label.btn-2:hover::before {
            right: 75%;
        }
    </style>
@endpush
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">

            <div class="page-title">
                <div class="title_left">
                    <h5><b style="color: black;">Edit: {{$user->name}}</b></h5>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    {{-- <h4>Edit Artist</h4> --}}
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="artist-edit-form">save</button>
                            <button class="admin-form-close-btn" onclick="goBack()">close</button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form id="artist-edit-form" method="POST" action="{{route('user.update',$user->id)}}"
                      class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-lg-4 pr-md-4 pl-md-4 mt-md-4" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="name">Name<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <input type="text" id="name" name="name" required value="{{$user->name}}"
                                           class="form-control col-12"/>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->
                        
                        

                        

                        <div class="col-lg-4 pr-md-4 pl-md-4 mt-md-4" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="name">Email<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <input type="email"  readonly="true" required
                                           value="{{$user->email}}"
                                           class="form-control col-12"/>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="phone">Phone</label>
                                <div class="col-12">
                                    <input type="tel" id="phone" name="phone"  value="{{$user->phone}}"
                                           class="form-control col-12"/>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        



                        <div class="col-lg-4 pr-md-4 pl-md-4 mt-md-4" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="status_id">Status<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <select
                                            name="status_id"
                                            id="status_id"
                                            data-route="{{route('select.ajax','Status')}}"
                                            data-name="name"
                                            data-value="_id"
                                            required>
                                        <option value="{{$user->status_id}}" selected>
                                            {{$user->status->name ??''}}
                                        </option>
                                    </select>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->


                        <div class="col-lg-4 pr-md-4 pl-md-4 mt-md-4" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="role_id">Role<span class="required" style="color:red">*</span></label>
                                <div class="col-12">
                                    <select
                                            name="role_id"
                                            id="role_id"
                                            data-route="{{route('select.ajax','Role')}}"
                                            data-name="name"
                                            data-value="_id"
                                            required>
                                        <option value="{{$user->role_id}}" selected>
                                            {{$user->role->name ??''}}
                                        </option>
                                    </select>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-lg-4 pr-md-4 pl-md-4 mt-md-4" style="min-height: 60px">
                            <div class="form-group">
                                <label class="control-label col-12" for="bio">Bio (Max 150)</label>
                                <div class="col-12">
                                    <textarea class="form-control" name="bio" id="bio"
                                              rows="1" maxlength="150">{{$user->bio}}</textarea>
                                </div>
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->

                        <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                            <div class="form-group">
                                <div class="col-md-12">
                                    
                                    <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="image"><i class="fa fa-window-close"
                                    aria-hidden="true"></i></a>
                                    <img class="image-display" id="src-image" src="{{$user->image != null ? asset($user->image) :asset('img/logo-placeholder.png') }}"   alt=""/>
                                </div>
                                <label class="control-label col-12" for="image">Photo (800x800 px)</label>
                                <div class="control-image-field col-12 d-flex flex-row">
                                    
                                    <input type="hidden" id="hidden_image" 
                                    name="hidden_image"  
                                    value="{{$user->image  != null ? 1 : 0}}"/>
                                    <input type="file" id="image" name="image" value="{{old('image')}}" onchange="readURL(this,$(this).parent().parent().find('.image-display'));" class="input-file d-none"/>
                                    <span class="file-input-name-preview col-8"> </span>
                                    <label class="upload-file-label col-3 offset-1" for="image">Upload</label>
                                </div>
                            </div>
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </form>

            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->

@endsection
@push('js')
    <script type='text/javascript'>
        ajaxSelect('status_id', 'Status','slug=active,in-active')
        ajaxSelect('role_id', 'Role', 'slug=admin,business-owner,user')

        $(function () {
            $('.SingleSelect2').select2({
                width: '100%',
            });
        });

        function goBack() {
            window.history.back();
        }
    
        $(document).ready(function () {
            $(".checkbox").click(function(){
                if($(".checkbox").is(':checked') ){
                    $(this).parent().find('option').prop("selected","selected");
                    $(this).parent().find('option').trigger("change");
                    $(this).parent().find('option').click();
                    
                }else{
                    $(this).parent().find('option').removeAttr("selected","selected");
                    $(this).parent().find('option').trigger("change");
                }
            });

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

        function preview_image(event, imageHolderId) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById(imageHolderId);
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function goBack() {
            window.history.back();
        }
    </script>
@endpush

