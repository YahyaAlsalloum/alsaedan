@extends('cms.layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-md-12 p-0">
            <div class="page-title">
                <div class="title_left">
                    <h5><b>{{ $title }}</b></h5>
                </div>
                @isset($date)
                    @push('css')
                        <style>
                            #cal-icon {
                                border-top-color: #ececec;
                                border-left-color: #ececec;
                                border-bottom-color: #ececec;
                            }

                            .daterangepicker {
                                left: 60% !important;
                                left: 63% !important;
                            }
                        </style>
                    @endpush
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-12 form-group float-right">
                            <div class="input-group">
                            <span class="add-on input-group-addon" id="cal-icon">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="reservation-time" id="reservation-time">
                                <span class="input-group-btn">
                                <button class="btn btn-default" id="btn-date-search" type="button">Go</button>
                            </span>
                            </div>
                        </div>
                    </div>
                @endisset
                {{-- <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-12 form-group float-right top_search">
                        <div class="float-right">
                            @isset($new)
                                <button type="button" style="" class="btn btn-new" onclick="window.location.href='{{ $new }}'">
                                    <i class="fas fa-plus"></i>   New
                                    </button>
                            @endisset
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @include('cms.layouts.datatable.widget-without-actions')
                        </div>
                    </div><!-- /.x_panel -->
                </div><!-- /.col-* -->
            </div><!-- /.row -->
        </div><!-- /.col-* -->
    </div><!-- /.container-fluid -->
@endsection
@push('css')
    <style>
        {{--        .dataTables_filter {--}}
        {{--            width: unset;--}}
        {{--        }--}}

        {{--        .page-title .title_right .pull-right {--}}
        {{--            margin: unset;--}}
        {{--        }--}}
    </style>
@endpush
