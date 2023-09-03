<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title', '')</title>
    
    <!-- Bootstrap -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- bootstrap-colorpicker -->
    <link href="{{ asset('vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}"
        rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('vendors/select2/dist/css/select2.css') }}" rel="stylesheet">
    <!-- Dropzone -->
    <link href="{{ asset('vendors/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('css/business-owner/custom3.css') }}" rel="stylesheet">
    
    <!-- CSS Files -->

    @yield('style')
    @toastr_css
    <style>
        #overlay {
            position: fixed;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            z-index: 5000000;
            height: 106%;
            width: 100%;
            text-align: center;
            background: #E7E7EB;
            vertical-align: middle;
        }

        #overlay img {
            height: 20%;
            width: 15%;
        }

        #cal-icon {
            border-radius: 25px 0px 0px 25px;
        }

        table.dataTable thead th:first-child .sorting_asc:after,
        table.dataTable thead th:first-child .sorting_desc:after {
            content: unset !important;
        }

        table.dataTable th:first-child thead th:first-child .sorting_asc,
        table.dataTable th:first-child thead th:first-child .sorting_desc {
            width: 20px !important;
        }

        #leftCol {
            position: fixed;
            width: 150px;
            overflow-y: scroll;
            overflow-x: hidden;
            top: 0;
            bottom: 0;
        }
    </style>
    @stack('css')
</head>

<body class="nav-md">
    <div class="container-fluid body p-0">
        <div class="main_container">
            {{--        <div id="overlay"> --}}
            {{--            <img src="{{ asset('img/dr.gif') }}"> --}}
            {{--        </div>iv id="overlay"> --}}
            {{--            <img src="{{ asset('img/dr.gif') }}"> --}}
            {{--        </div> --}}
            {{-- header with side bar --}}
            @include('cms.layouts.header')
            <div class="right_col menu" role="main">
                @yield('content')
            </div>
            @include('cms.layouts.footer')
        </div>

    </div>
    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    {{-- <script src="{{asset('/js/popper.min.js')}}"></script> --}}
    <!-- Bootstrap -->
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('vendors/DateJS/build/date.js') }}"></script>
    <!-- DropZone -->
    <script src="{{ asset('vendors/dropzone/dist/dropzone.js') }}"></script>
   <!-- bootstrap-colorpicker -->
    <script src="{{ asset('vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Moment -->
    {{-- <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script> --}}
    <!-- Select2 -->
    <script src="{{ asset('vendors/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/loudev-multiselect/js/jquery.multi-select.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/chart-pie-demo.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script src="{{asset('js/custom.js')}}"></script>
    @include('cms.layouts.form.javascript')

    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $('.remove-single-image').click(function() {
                var id = $(this).attr("data-id");
                document.getElementById('hidden_'+id).value = 0
                document.getElementById('src-' + id).src = '{{ asset('img/logo-placeholder.png') }}'
                clearFileInput(document.getElementById(id));

            });
        });

        function clearFileInput(ctrl) {
            try {
                ctrl.value = null;
                // console.log(ctrl)
            } catch (ex) {}
            if (ctrl.value) {
                ctrl.parentNode.replaceChild(ctrl.cloneNode(true), ctrl);
            }
        }
        
        $(function() {
            $('.select2-multiple').select2({
                width: '100%',
                closeOnSelect: false,
                multiple: true,
            });
            $('.select2-without-ajax').select2({
                width: '100%',
                closeOnSelect: false,
                allowClear: true,
            });
            $('.select2-without-ajax-single').select2({
                width: '100%',
                closeOnSelect: true,
                allowClear: true,
            });
            $("a[data-original-title='FullScreen']").on('click', function() {
                toggleFullScreen();
            });

            function toggleFullScreen() {
                document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement ||
                    document.msFullscreenElement ?
                    document.exitFullscreen ?
                    document.exitFullscreen() :
                    document.msExitFullscreen ?
                    document.msExitFullscreen() :
                    document.mozCancelFullScreen ?
                    document.mozCancelFullScreen() :
                    document.webkitExitFullscreen && document.webkitExitFullscreen() :
                    document.documentElement.requestFullscreen ?
                    document.documentElement.requestFullscreen() :
                    document.documentElement.msRequestFullscreen ?
                    document.documentElement.msRequestFullscreen() :
                    document.documentElement.mozRequestFullScreen ?
                    document.documentElement.mozRequestFullScreen() :
                    document.documentElement.webkitRequestFullscreen && document.documentElement
                    .webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)
            }
            window.reset = function(e) {
                e.wrap('<form>').closest('form').get(0).reset();
                e.unwrap();
            };
        });
        var coll = document.getElementsByClassName("clp");
        var i;
        for (i = 0; i < coll.length; i++) {
            coll[i].querySelector('.clp-toggler').addEventListener("click", function() {
                var clp = this.closest('.clp')
                clp.classList.toggle("active");
                var content = clp.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                    clp.querySelector('.clp-toggler').innerHTML = "Show"
                    clp.classList.remove("active");
                } else {
                    clp.classList.add("active");
                    content.style.display = "block";
                    clp.querySelector('.clp-toggler').innerHTML = "Hide"
                }
                try {
                    setTimeout(function() {
                        $($.fn.dataTable.tables(true)).DataTable()
                            .columns.adjust();
                    }, 500);
                    var oSettings = $($.fn.dataTable.tables(true)).DataTable().fnSettings();
                    oSettings.oScroll.sY = '600px';
                    $($.fn.dataTable.tables(true)).DataTable().fnDraw();
                } catch (e) {

                }
            });
        }

        function resetPage() {
            location.reload();
        }
    </script>

<script type="text/javascript">
 function editAjaxForm() {
            console.log('aaaa')

            let url = $('#inputval').val();
            $.ajax({
                type: 'GET',
                url: url,
             
                dataType: 'json',
                success: function(data) {
                    $('#model-view').html(data.view);
                },
                error: function(data) {}
            });

        }
</script>
    @stack('js')
    
    
    {{-- <script type="module" src="{{ asset('js/custom.js') }}"></script> --}}
    
    {{-- <script type="module" src="{{ asset('js/custom.min.js') }}"></script> --}}
</body>
@toastr_js
@toastr_render

</html>
