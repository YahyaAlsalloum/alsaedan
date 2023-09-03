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
            @if(!isset($disable_list_link) || (isset($disable_list_link) && $disable_list_link))
                <a href="{{route('user.index')}}" class="nav navbar-right panel_toolbox">
                    <i class="fa fa-list"></i>
                    View list Of <span class="text-uppercase">@if(!isset($linkDisplay)){{ $title }} @else {{ $linkDisplay }} @endif</span>
                </a>
            @endif
            <div class="page-title">
                <div class="title_left">
                    <h5><b style="color: black;">{{$title}}</b></h5>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    {{-- <h4>{{ $title }}</h4> --}}
                    
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->
                <form id="user-create-form" method="POST" action="{{route('user.store')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">User Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="name" name="name" required value="{{old('name')}}" class="form-control col-md-7 col-xs-12"/>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                        
                        <div class="form-group">
                            <div class="cms-image">
                                <img src="{{asset('img/logo-placeholder.png')}}" id="image-holder" height="150"
                                        width="150" style="display: block;margin: 0 25%;">
                                <br>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12" >
                                <label class="control-label col-md-6 col-sm-6 col-xs-12" for="last-name">
                                    image
                                    <span class="required" style="color:red">*</span>
                                </label>
                                <input type="file" id="image" onchange="preview_image(event)" name="image" readonly="true" >
                                <label for="image" class="btn-2">upload</label>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id">Select Role</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="select2 select2-ajax"
                                        name="role_id"
                                        id="role_id"
                                        data-route="{{route('select.ajax','Role')}}"
                                        data-name="name"
                                        data-value="_id" required>
                                    @if(old('role_id') != null)
                                        <option value="{{old('role_id')}}" selected>
                                            {{\App\Models\Role::find(old('role_id'))->name}}
                                        </option>
                                    @endif
                                </select>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-success btn-submit-model" type="submit" form="user-create-form">Submit</button>
                                <button class="btn btn-primary">reset</button>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    @include('cms.layouts.form.javascript')
    
    <script type='text/javascript'>
        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('image-holder');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
    
        ajaxSelect('role_id','Role')
        $(function () {
            $('.SingleSelect2').select2({
                width: '100%',
            });
        });
        function readURL(input,preview) {
            
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
    </script>
@endpush
