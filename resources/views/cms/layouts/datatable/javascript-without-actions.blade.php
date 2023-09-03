<script src="{{asset('vendors/DataTables/datatables.js')}}"></script>
<script src="{{asset('vendors/DataTables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Buttons-1.6.3/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Buttons-1.6.3/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Buttons-1.6.3/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Buttons-1.6.3/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/JSZip-2.5.0/jszip.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Buttons-1.6.3/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/FixedHeader-3.1.7/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/FixedHeader-3.1.7/js/fixedHeader.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/KeyTable-2.5.2/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/KeyTable-2.5.2/js/keyTable.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Responsive-2.2.5/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Responsive-2.2.5/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Scroller-2.0.2/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Scroller-2.0.2/js/scroller.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Select-1.3.1/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/Select-1.3.1/js/select.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/DataTables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/sweet-alerts/sweetalert.min.js')}}"></script>

<script>
    $(function () {
        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds) {
                    break;
                }
            }
        }


        var table = $('#table').DataTable({
            fnInitComplete: () => {
                $('#table_processing').css({'height': '50px', 'z-index': '100'});
            },
            processing: true,
            responsive: true,
            fixedHeader: true,
            "order": [[1, "asc"]],
            serverSide: true,
            autoWidth: true,
            paging: true,
            pageLength: 25,
            bFilter: true,
            bLengthChange: true,
            searching: true,
            bSortable: true,
            dom: "Brtip",
            scrollY: "500px",
            scrollCollapse: true,
            select:true,
            buttons:
                [
                    {
                        text: '<img src="/img/excel-export.png" class="excel-export-img" alt="">EXPORT' ,extend: "excel", className: "btn-sm dt-excel-export-btn", exportOptions: {
                            columns: "th:not(:last-child)"
                        }
                    },
                    {
                        text: '<div class="bars"><div></div><div></div><div></div></div>', className: "btn-sm dt-bars-btn"
                    },
                    {{--{--}}
                    {{--    extend: "print", className: "btn-sm", exportOptions: {--}}
                    {{--        columns: "th:not(:last-child)"--}}
                    {{--    },--}}
                    {{--    customize: function (win) {--}}
                    {{--        let company = ('{{ $company }}');--}}
                    {{--        company = JSON.parse(company.replace(/&quot;/g, '"').trim('\"'));--}}
                    {{--        let header = '<div style="width: 100%;">';--}}
                    {{--        header += '<p style="float: left;">';--}}
                    {{--        header += company.name !== null ? '<b>' + company.name + '</b><br>' : '';--}}
                    {{--        header += company.address !== null ? '<b>address:</b>' + company.address + '<br>' : '';--}}
                    {{--        header += company.phone !== null ? '<b>phone:</b>' + company.phone + '<br>' : '';--}}
                    {{--        header += company.email !== null ? '<b>email:</b>' + company.email + '<br>' : '';--}}
                    {{--        header += '</p>';--}}
                    {{--        header +=--}}
                    {{--            '<div style="float: right;">' +--}}
                    {{--            '<img height="100" width="100" src="' + encodeURI(company.logo) + '">' +--}}
                    {{--            '</div></div>' +--}}
                    {{--            '<div style="clear:both"></div>';--}}
                    {{--        $(win.document.body).prepend(header);--}}
                    {{--        sleep(1000);--}}
                    {{--    }--}}
                    {{--}--}}
                ],
            columns:
                [

                    {data: 'DT_RowIndex', width: "10%", sortable: false, orderable: false, searchable: false},
                        @foreach( $fields as  $value)
                    {
                        data: '{{$value['key']}}', name: '{{$value['db_name']}}'
                        @if($value['type'] == 'object')
                        , className: 'td-clickable'
                        @endif
                    },
                        @endforeach

                ],
            lengthMenu:
                [[1, 5, 10, 25, 50, 100], [1, 5, 10, 25, 50, 100]],
            pagingType:
                "simple_numbers",
            language:
                {
                    // paginate: {
                    //     previous: "<i class='fa fa-angle-left'></i>",
                    //     next: "<i class='fa fa-angle-right'></i>"
                    // }
                    // "processing": "***"
                }
            ,
            ajax: {
                url: "{{$route}}",
                data: function (d) {
                    var reservation_time = $('#reservation-time');
                    if (typeof reservation_time.val() != "undefined") {
                        let datevals = reservation_time.val().split(' - ');
                        d.from = datevals[0].trim();
                        d.to = datevals[1].trim();
                    }
                }
            }
        });



        $('table.dataTable').on('click', '.btn-delete-model', function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover again !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (!willDelete) {
                    return false;
                } else {
                    var _token = $(this).parent().find('input[name="_token"]').val();
                    var route = $(this).parent().attr('action');
                    $.ajax({
                        url: route,
                        type: "DELETE",
                        data: {
                            _token: _token,
                            _method: 'DELETE'
                        },
                        success: function () {
                            swal(
                                'Deleted!',
                                'Successfully',
                                'success'
                            );
                            table./*api().*/ajax.reload();
                        }
                    });
                }
            });
        });

    });

</script>
