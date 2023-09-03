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
        
            <div class="page-title">
                <div class="title_left">
                    <h5><b style="color: black;">Commission</b></h5>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    {{-- <h4>Commission</h4> --}}
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->
                <form method="POST" action="{{route('commission.store')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label class="control-label col-12" for="salon_percentage">Salon Percentage</label>
                                <div class="col-12">
                                    <input type="number" id="salon_percentage" name="salon_percentage" required value="{{old('salon_percentage')}}" class="form-control col-12 "/>
                                </div><!-- /.col-* -->
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-label col-12" for="resevation_commission">Resevation Commission</label>
                                <div class="col-12">
                                    <input type="number" id="resevation_commission" name="resevation_commission" required value="{{old('resevation_commission')}}" class="form-control col-12 "/>
                                </div><!-- /.col-* -->
                            </div><!-- /.form-group -->


                        <div class="form-group">
                            <div class="col-md-2 col-sm-3 col-xs-12 col-md-offset-10">
                                <button type="submit" class="btn btn-success btn-submit-model">
                                    Create
                                </button>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->

                    </form>
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
