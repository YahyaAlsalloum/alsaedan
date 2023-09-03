@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
             <a class="form-list-of" href="javascript:window.history.back()">
                        <i class="fas fa-chevron-left"></i>

                    </a>
                    
            <div class="page-title">
                <div class="title_left">
                    <h5><b style="color: black;">{{ $title??'' }}</b></h5>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                        {{-- <h5>{{ $title??'' }}</h5> --}}

                    <ul class="nav navbar-right panel_toolbox">
                        {{--                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="form">submit</button>
                            <button class="admin-form-close-btn" onclick="resetPage()">reset</button>

{{--                            <button class="admin-form-save-btn" type="submit" form="form">@if($method=="PUT") save @else submit@endif</button>--}}
{{--                            <button class="admin-form-close-btn">@if($method=="PUT") close @else reset @endif</button>--}}
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    {!! $form !!}
                </div>
            </div>
            @if (session()->has('conflict'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <strong>{!! session()->get('conflict') !!}</strong>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('css')
    <link href="{{asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/loudev-multiselect/css/multi-select.css')}}" rel="stylesheet">
    {{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">--}}
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
@push('js')
    <script src="{{ asset('vendors/loudev-multiselect/js/jquery.multi-select.js') }}"></script>
    @include('cms.layouts.form.javascript')
    <script>
        CKEDITOR.replace('description');
    </script>
    
@endpush
