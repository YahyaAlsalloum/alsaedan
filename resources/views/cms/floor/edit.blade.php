@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Floor Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="floor-details-form">save
                            </button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>

                            <button class="admin-form-close-btn" onclick="window.location.href='{{ route('building.edit', $floor->building_id) }}'">close</button>
                            
                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form id="floor-details-form" method="POST"
                    action="{{ route('floor.update', $floor->_id) }}" class="form-horizontal form-label-left"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="clp">
                                <h5>
                                    Floor Info
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Floor Name<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="name" name="name" required
                                                value="{{ $floor->name }}" class="form-control col-12" />
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
                                                @if (isset($floor->status))
                                                    <option value="{{ $floor->status->_id }}" selected>
                                                        {{ $floor->status->name }}</option>
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
                                            <input type="hidden" id="floor_id" name="floor_id" required
                                                value="{{ $floor->building_id }}"  class="form-control col-12" />
                                            <input type="text"  required
                                                value="{{ $floor->building->name }}" readonly class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->



                                {{-- <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="logo"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-logo"
                                                src="{{ $floor->logo != null ? asset($floor->logo) : asset('img/logo-placeholder.png') }}"
                                                alt="" />
                                        </div>
                                        <label class="control-label col-12" for="logo">Floor Logo Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">
                                            <input type="hidden" id="hidden_logo" name="hidden_logo"
                                                value="{{ $floor->logo != null ? 1 : 0 }}" />

                                            <input type="file" id="logo" name="logo" value="{{ old('logo') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1" for="logo">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* --> --}}
                                {{-- <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="cover_image"><i
                                                    class="fa fa-window-close" aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-cover_image"
                                                src="{{ $floor->cover_image != null ? asset($floor->cover_image) : asset('img/logo-placeholder.png') }}"
                                                alt="" />
                                        </div>
                                        <label class="control-label col-12" for="cover_image">Floor Cover Photo (
                                            900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">

                                            <input type="hidden" id="hidden_cover_image" name="hidden_cover_image"
                                                value="{{ $floor->cover_image != null ? 1 : 0 }}" />
                                            <input type="file" id="cover_image" name="cover_image"
                                                value="{{ old('cover_image') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1"
                                                for="cover_image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* --> --}}
                                
                                {{-- <div class="col-lg-12 pr-md-12 pl-md-12 p-0 mt-md-12 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="description">Description</label>
                                        <div class="col-12">
                                            <textarea class="col-md-12 form post-text" name="description" maxlength="150">{!! $floor->description !!}</textarea>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* --> --}}
                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->

                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Apartments
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="panel-body">
                                    @php($model = new App\Models\Apartment())
                                    <div class="tab-content">
                                        @php(
                                            $compacts = [
                                                'title' => $model->title,
                                                'fields' => $model->fields,
                                                'route' => route('apartment.index', 'floor_id='.$floor->_id),
                                                'new' => route('apartment.create'),
                                            ]
                                        )
                                        <div class="title_right">
                                            <div class="col-md-5 col-sm-5 col-12 form-group float-right top_search" style="margin: 15px;">
                                                <div class="float-right">
                                                    <button type="button" style="" class="btn btn-new"
                                                        onclick="window.location.href='{{ route('apartment.create', 'floor_id='.$floor->_id) }}'">
                                                        <i class="fas fa-plus"></i> New
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @include('cms.layouts.datatable.sub-widget', $compacts);
                                        <div class="model-view" id="model-view">
                                            
                                        </div>
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
        ajaxSelect('status_id', 'Status')
        ajaxSelect('floor_id', 'Building')

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

        function goBack() {
            window.history.back();
        }
    </script>

@endpush
