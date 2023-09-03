@push('css')
    <link href="{{asset('vendors/DataTables/datatables.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/DataTables/DataTables-1.10.21/css/datatables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/DataTables/FixedHeader-3.1.7/css/fixedHeader.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/DataTables/Responsive-2.2.5/css/responsive.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/DataTables/Scroller-2.0.2/css/scroller.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/DataTables/Select-1.3.1/css/select.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/sweet-alerts/sweetalert.css')}}" rel="stylesheet">
    <style>
        #table_processing {
            z-index: 100;
            height: 50px;
        }

        .dataTables_filter {
            width: unset;
        }

        .page-title .title_right .pull-right {
            margin: unset;
        }

        .buttons-colvis {
            height: 30px;
        }
    </style>
@endpush
<table class=" table ajax-table table-bordered-bottom dataTable no-footer" id="table" cellspacing="0"
       width="100%" style="margin-top:0!important;">
    @include('cms.layouts.datatable.header')
</table>
@push('js')
    @include('cms.layouts.datatable.javascript')
@endpush
