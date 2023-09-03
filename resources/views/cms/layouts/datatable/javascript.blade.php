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
            searching: true,
            processing: true,
            responsive: true,
            fixedHeader: false,
            "order": [[0, "asc"]],
            autoWidth: true,
            paging: true,
            pageLength: 25,
            bFilter: true,
            bLengthChange: true,
            dom: "Blfrtip",
            scrollY: "500px",
            scrollCollapse: true,
            select:true,
            buttons:
                [
                    
                    {
                        extend: "csv", className: "btn-sm dt-excel-export-btn", exportOptions: {
                            columns: "th:not(:last-child)",
                            modifier: {
                                page: 'all',
                                search: 'none'
                            }
                        }
                    },
                    {
                        extend: "excel", className: "btn-sm dt-excel-export-btn", exportOptions: {
                            columns: "th:not(:last-child)",
                            modifier: {
                                page: 'all',
                                search: 'none'
                            }
                        }
                    },
                    {
                        extend: "pdfHtml5", className: "btn-sm dt-excel-export-btn", exportOptions: {
                            columns: "th:not(:last-child)",
                            modifier: {
                                page: 'all',
                                search: 'none'
                            }
                        }
                    },
                    {

                        extend: "print", className: "btn-sm dt-excel-export-btn", exportOptions: {
                            columns: "th:not(:last-child)",
                            modifier: {
                                page: 'all',
                                search: 'none'
                            }
                        },

                    },
                    // {
                    //     text: '<img src="/img/excel-export.png" class="excel-export-img" alt="">EXPORT' ,
                    //     extend: "excel",
                    //     className: "btn-sm dt-excel-export-btn",
                    //     action: newexportaction,
                    //     columns: "th:not(:last-child)"
                    // },
                    // {
                    //     text: '<div class="bars"><div></div><div></div><div></div></div>', className: "btn-sm dt-bars-btn"
                    // },

                ],
            columns:
                [
            
                    {data: 'DT_RowIndex', width: "10%", sortable: false, orderable: false, searchable: true},
                        @foreach( $fields as  $value)
                    {
                        data: '{{$value['key']}}', name: '{{$value['db_name']}}'
                        @if($value['type'] == 'object')

                        , className: 'td-clickable'
                        @endif
                    },
                        @endforeach
                    {
                        data: 'action', width: "30%", sortable: false, orderable: false, searchable: true
                    }
                ],
            // lengthMenu:
            //     [[1, 5, 10, 25, 50, 100], [1, 5, 10, 25, 50, 100]],
            // pagingType:
            //     "simple_numbers",
            // language:
            //     {

            //     }
            // ,

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

        $('table.dataTable').on('click', '.btn-hide-model', function (e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "",
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
                        type: "POST",
                        data: {
                            _token: _token,
                            _method: 'POST'
                        },
                        success: function () {
                            swal(
                                'Status Changed!',
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
        function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });
        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    };

</script>
