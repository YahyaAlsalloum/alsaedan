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
    <div class="row">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>About</h5>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->
                <div class="row">
                    <form method="POST" action="{{route('about.store')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @csrf
                            <div class="col-md-10 col-sm-12 offset-md-2">
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-12" for="about">
                                        About
                                    </label>
                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                      <textarea class="form-control" id="about" name="about" rows="10"
                                                required="required">{{old('about')}}</textarea>
                                    </div><!-- /.col-* -->
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-12 col-xs-12" for="address">
                                        Address
                                    </label>
                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                        <input type="text" id="address" name="address" required
                                               value="{{old('address')}}" class="form-control col-12"/>
                                    </div><!-- /.col-* -->
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-12" for="email">
                                        Email
                                    </label>
                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                        <input type="text" id="email" name="email" required
                                               value="{{old('email')}}" class="form-control col-12"/>
                                    </div><!-- /.col-* -->
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-12 col-xs-12" for="phone">
                                        Phone
                                    </label>
                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                        <input type="text" id="phone" name="phone" required
                                               value="{{old('phone')}}" class="form-control col-12"/>
                                    </div><!-- /.col-* -->
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <div style="width:100%;text-align: center;">
                                        <img src="{{asset('img/logo-placeholder.png')}}" id="image-holder" height="150"
                                             width="150" style="display: block;margin: 0 25%;">
                                        <br>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12" >
                                        <label class="control-label col-md-4 col-sm-3 col-12" for="last-name">
                                            Logo Link
                                            <span class="required" style="color:red">*</span>
                                        </label>
                                        <input type="file" id="image" name="image" onchange="preview_image(event)" required/>
                                        <label for="image" class="btn-2">upload</label>
                                    </div><!-- /.col-* -->
                                </div><!-- /.form-group -->

                            </div><!-- /.col-* -->
                        <div class="form-group">
                            <div class="col-md-2 col-sm-3 col-12 offset-md-10">
                                <button type="submit" class="btn btn-success btn-submit-model">
                                    Create
                                </button>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    </form>
                </div><!-- /.row -->
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
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
@endpush
