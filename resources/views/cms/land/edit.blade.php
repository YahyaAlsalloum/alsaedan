@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Land Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="land-details-form">save
                            </button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>

                            <button class="admin-form-close-btn" onclick="window.location.href='{{  route('realestate.edit', $land->realestate_id)}}'">close</button>

                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form id="land-details-form" method="POST"
                    action="{{ route('land.update', $land->_id) }}" class="form-horizontal form-label-left"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="clp">
                                <h5>
                                    Land Info
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Land Name<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="name" name="name" required
                                                value="{{ $land->name }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->


                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Status<span class="required"
                                                style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax" id="status_id"
                                                data-route="{{ route('select.ajax', 'Status') }}" data-name="name"
                                                data-value="_id" onchange="ajaxSelect('status_id','Status')"
                                                name="status_id" required>
                                                @if (isset($land->status))
                                                    <option value="{{ $land->status->_id }}" selected>
                                                        {{ $land->status->name }}</option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->

                                
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Realestate<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="hidden" id="realestate_id" name="realestate_id" required
                                                value="{{ $land->realestate_id }}"  class="form-control col-12" />
                                            <input type="text"  required
                                                value="{{ $land->realestate->name }}" readonly class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->


                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->



                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Plots
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="panel-body">
                                    @php($plot = new App\Models\Plot())
                                    <div class="tab-content">
                                        @php(
                                            $compacts = [
                                                'title' => $plot->title,
                                                'fields' => $plot->fields,
                                                'route' => route('plot.index', 'land_id='.$land->_id),
                                                'new' => route('plot.create'),
                                            ]
                                        )
                                        <div class="title_right">
                                            <div class="col-md-5 col-sm-5 col-12 form-group float-right top_search" style="margin: 15px;">
                                                <div class="float-right">
                                                    <button type="button" style="" class="btn btn-new"
                                                        onclick="window.location.href='{{ route('plot.create', 'land_id='.$land->_id) }}'">
                                                        <i class="fas fa-plus"></i> New
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @include('cms.layouts.datatable.sub-widget', $compacts);
                                       
                                    </div><!-- /.tab-content -->
                                </div><!-- /.panel-body -->
                            </div><!-- /.row.clpc -->
                        </div>


                    </div><!-- /.row -->
                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    <script>
        CKEDITOR.replace('description');
        ajaxSelect('status_id', 'Status', 'slug=in-active,active')

        $(function() {
            $('.select2-multiple').select2({
                width: '100%',
                multiple: true,
            });
        });

        function readURL(input, preview) {

            var id = input.id;
            document.getElementById('hidden_' + id).value = 1
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.show()
                    preview.attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

@endpush
