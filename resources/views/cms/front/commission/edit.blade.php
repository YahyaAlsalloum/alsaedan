@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
        
            <div class="page-title">
                <div class="title_left">
                    <h5><b style="color: black;">Commission</b></h5>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    {{-- <h5>Commission</h5> --}}
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="commission-edit-form">save</button>
                            <button class="admin-form-close-btn" onclick="goBack()">close</button>
                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form method="POST" id="commission-edit-form" action="{{route('commission.update',$commission->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    
                    <div class="col-lg-4 pr-md-4 pl-md-4 mt-md-4" style="min-height: 60px">
                        <div class="form-group">
                            <label class="control-label col-12" for="salon_percentage">Salon Percentage</label>
                            <div class="col-12">
                                <input type="number" id="salon_percentage" name="salon_percentage"  required
                                        value="{{$commission->salon_percentage}}"
                                        class="form-control col-12"/>
                            </div>
                        </div><!-- /.form-group -->
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 pr-md-4 pl-md-4 mt-md-4" style="min-height: 60px">
                        <div class="form-group">
                            <label class="control-label col-12" for="resevation_commission">Resevation Commission</label>
                            <div class="col-12">
                                <input type="number" id="resevation_commission" name="resevation_commission"  required
                                        value="{{$commission->resevation_commission}}"
                                        class="form-control col-12"/>
                            </div>
                        </div><!-- /.form-group -->
                    </div><!-- /.col-* -->
                    

                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script type='text/javascript'>


        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('image-holder');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        ClassicEditor
            .create(document.querySelector('.editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
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

        function readURL(input, preview) {
            
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

        function goBack() {
            window.history.back();
        }
    </script>
@endpush
