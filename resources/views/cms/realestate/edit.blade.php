@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Realestate Project Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="realestate-details-form">save
                            </button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>

                            <button class="admin-form-close-btn"
                                onclick="window.location.href='{{ route('realestate.index') }}'">close</button>
                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form id="realestate-details-form" method="POST"
                    action="{{ route('realestate.update', $realestate->_id) }}" class="form-horizontal form-label-left"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="clp">
                                <h5>
                                    Realestate Project Info
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Realestate Name<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="name" name="name" required
                                                value="{{ $realestate->name }}" class="form-control col-12" />
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
                                                @if (isset($realestate->status))
                                                    <option value="{{ $realestate->status->_id }}" selected>
                                                        {{ $realestate->status->name }}</option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="projectCategory_id">Project Category<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" required value="{{ $realestate->projectCategory->name }}"
                                                readonly class="form-control col-12" />
                                            <input type="hidden" required value="{{ $realestate->projectCategory->_id }}"
                                                name="projectCategory_id" readonly class="form-control col-12" />
                                            {{-- <select class="select2 " id="projectCategory_id"
                                                data-route="{{ route('select.ajax', 'ProjectCategory') }}"
                                                 data-name="name"
                                                data-value="_id"
                                                onchange="ajaxSelect('projectCategory_id','ProjectCategory')"
                                                name="projectCategory_id" readOnly required>
                                                @if (isset($realestate->projectCategory_id))
                                                    <option value="{{ $realestate->projectCategory->_id }}" selected>
                                                        {{ $realestate->projectCategory->name }}</option>
                                                @endif
                                            </select> --}}
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="salesStatus_id">Sales Status<span
                                                class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax" id="salesStatus_id"
                                                data-route="{{ route('select.ajax', 'SalesStatus') }}" data-name="name"
                                                data-value="_id" onchange="ajaxSelect('salesStatus_id','SalesStatus')"
                                                name="salesStatus_id" required>
                                                @if (isset($realestate->salesStatus_id))
                                                    <option value="{{ $realestate->salesStatus->_id }}" selected>
                                                        {{ $realestate->salesStatus->name }}</option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Project Feature</label>
                                        <div class="col-12">
                                            <select class="select2 select2-without-ajax" name="projectFeature_ids[]"
                                                id="projectFeature_ids" multiple>
                                                @foreach ($projectFeatures as $projectFeature)
                                                    <option value="{{ $projectFeature->_id }}"
                                                        @if ($realestate->projectFeature_ids != null and in_array($projectFeature->_id, $realestate->projectFeature_ids)) selected @endif>
                                                        {{ $projectFeature->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Project Service</label>
                                        <div class="col-12">
                                            <select class="select2 select2-without-ajax" name="projectService_ids[]"
                                                id="projectService_ids" multiple>
                                                @foreach ($projectServices as $projectService)
                                                    <option value="{{ $projectService->_id }}"
                                                        @if ($realestate->projectService_ids != null and in_array($projectService->_id, $realestate->projectService_ids)) selected @endif>
                                                        {{ $projectService->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Project Guarantee</label>
                                        <div class="col-12">
                                            <select class="select2 select2-without-ajax" name="projectGuarantee_ids[]"
                                                id="projectGuarantee_ids" multiple>
                                                @foreach ($projectGuarantees as $projectGuarantee)
                                                    <option value="{{ $projectGuarantee->_id }}"
                                                        @if ($realestate->projectGuarantee_ids != null and in_array($projectGuarantee->_id, $realestate->projectGuarantee_ids)) selected @endif>
                                                        {{ $projectGuarantee->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="virtual_navigation">Virtual
                                            Navigation</label>
                                        <div class="col-12">
                                            <input type="text" id="virtual_navigation" name="virtual_navigation"
                                                value="{{ $realestate->virtual_navigation }}"
                                                class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="land_space">Land Space</label>
                                        <div class="col-12">
                                            <input type="text" id="land_space" name="land_space"
                                                value="{{ $realestate->land_space }}" class="form-control col-12" />
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->


                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="description">Description</label>
                                        <div class="col-12">
                                            <textarea class="col-md-12 form post-text" name="description" maxlength="150">{!! $realestate->description !!}</textarea>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->

                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="logo"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-logo"
                                                src="{{ $realestate->logo != null ? asset($realestate->logo) : asset('img/logo-placeholder.png') }}"
                                                alt="" />
                                        </div>
                                        <label class="control-label col-12" for="logo">Realestate Logo Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">
                                            <input type="hidden" id="hidden_logo" name="hidden_logo"
                                                value="{{ $realestate->logo != null ? 1 : 0 }}" />

                                            <input type="file" id="logo" name="logo"
                                                value="{{ old('logo') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1" for="logo">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="cover_image"><i
                                                    class="fa fa-window-close" aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-cover_image"
                                                src="{{ $realestate->cover_image != null ? asset($realestate->cover_image) : asset('img/logo-placeholder.png') }}"
                                                alt="" />
                                        </div>
                                        <label class="control-label col-12" for="cover_image">Realestate Cover Photo (
                                            900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">

                                            <input type="hidden" id="hidden_cover_image" name="hidden_cover_image"
                                                value="{{ $realestate->cover_image != null ? 1 : 0 }}" />
                                            <input type="file" id="cover_image" name="cover_image"
                                                value="{{ old('cover_image') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1"
                                                for="cover_image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                                <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                                style="position:absolute;" data-id="banner"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-banner"
                                                src="{{ $realestate->banner != null ? asset($realestate->banner) : asset('img/logo-placeholder.png') }}"
                                                alt="" />
                                        </div>
                                        <label class="control-label col-12" for="banner">Realestate Banner (
                                            900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">

                                            <input type="hidden" id="hidden_banner" name="hidden_banner"
                                                value="{{ $realestate->banner != null ? 1 : 0 }}" />
                                            <input type="file" id="banner" name="banner"
                                                value="{{ old('banner') }}"
                                                onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                class="input-file d-none" />
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1" for="banner">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->


                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Sales Color
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">

                                @foreach ($apartmentStatuses as $apartmentStatus)
                                    <div class="col-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="colors"
                                                style="text-align: center !important;">{{ $apartmentStatus->name }}</label>
                                            <div class="col-12">

                                                <input type="hidden" name="colors_ids[]" required
                                                    class="form-control col-12" value="{{ $apartmentStatus->_id }}" />
                                                <input type="color" id="color" name="colors[]" required
                                                    @if (isset($realestate->colors) and $realestate->colors != null) @foreach ($realestate->colors as $color)
                                                                @if ($color['colors_id'] == $apartmentStatus->_id)
                                                                    value="{{ $color['color'] }}" @endif
                                                    @endforeach
                                @endif
                                class="form-control col-12" />
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    </div><!-- /.col-* -->
                    @endforeach

                    <div class="col-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                        <div class="form-group">
                            <label class="control-label col-12"
                                for="main_color"style="text-align: center !important;">Main color</label>
                            <div class="col-12">

                                <input type="color" id="main_color" name="main_color" required
                                    value="{{ $realestate->main_color }}" class="form-control col-12" />
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    </div><!-- /.col-* -->
                    <div class="col-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                        <div class="form-group">
                            <label class="control-label col-12"
                                for="secondary_color"style="text-align: center !important;">Secondary color</label>
                            <div class="col-12">

                                <input type="color" id="secondary_color" name="secondary_color" required
                                    value="{{ $realestate->secondary_color }}" class="form-control col-12" />
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    </div><!-- /.col-* -->
            </div><!-- /.row.clpc -->
        </div>
        @if (isset($realestate->projectCategory_id) and $realestate->projectCategory_id != null)
            @foreach ($realestate->projectCategory->appearanceModules as $apModule)
                @if ($apModule->slug == 'buildings')
                    <div class="col-12">
                        <div class="clp mt-4">
                            <h5>Buildings
                                <span class="float-right">
                                    <button class="clp-toggler" type="button">Hide</button>
                                </span>
                            </h5>
                            <hr class="rounded form-horizontal-line">
                        </div><!-- /.clp -->
                        <div class="row clpc active" style="display: block;">
                            <div class="panel-body">
                                @php($model = new App\Models\Building())
                                <div class="tab-content">
                                    @php(
    $compacts = [
        'title' => $model->title,
        'fields' => $model->fields,
        'route' => route('building.index', 'realestate_id=' . $realestate->_id),
        'new' => route('building.create'),
    ]
)
                                    <div class="title_right">
                                        <div class="col-md-5 col-sm-5 col-12 form-group float-right top_search"
                                            style="margin: 15px;">
                                            <div class="float-right">
                                                <button type="button" style="" class="btn btn-new"
                                                    onclick="window.location.href='{{ route('building.create', 'realestate_id=' . $realestate->_id) }}'">
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
                @endif
                @if ($apModule->slug == 'villas')
                    <div class="col-12">
                        <div class="clp mt-4">
                            <h5>Villas
                                <span class="float-right">
                                    <button class="clp-toggler" type="button">Hide</button>
                                </span>
                            </h5>
                            <hr class="rounded form-horizontal-line">
                        </div><!-- /.clp -->
                        <div class="row clpc active" style="display: block;">
                            <div class="panel-body">
                                @php($villa = new App\Models\Villa())
                                <div class="tab-content">
                                    @php(
    $compacts = [
        'title' => $villa->title,
        'fields' => $villa->fields,
        'route' => route('villa.index', 'realestate_id=' . $realestate->_id),
        'new' => route('villa.create'),
    ]
)
                                    <div class="title_right">
                                        <div class="col-md-5 col-sm-5 col-12 form-group float-right top_search"
                                            style="margin: 15px;">
                                            <div class="float-right">
                                                <button type="button" style="" class="btn btn-new"
                                                    onclick="window.location.href='{{ route('villa.create', 'realestate_id=' . $realestate->_id) }}'">
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
                @endif
                @if ($apModule->slug == 'lands')
                    <div class="col-12">
                        <div class="clp mt-4">
                            <h5>Lands
                                <span class="float-right">
                                    <button class="clp-toggler" type="button">Hide</button>
                                </span>
                            </h5>
                            <hr class="rounded form-horizontal-line">
                        </div><!-- /.clp -->
                        <div class="row clpc active" style="display: block;">
                            <div class="panel-body">
                                @php($land = new App\Models\Land())
                                <div class="tab-content">
                                    @php(
    $compacts = [
        'title' => $land->title,
        'fields' => $land->fields,
        'route' => route('land.index', 'realestate_id=' . $realestate->_id),
        'new' => route('land.create'),
    ]
)
                                    <div class="title_right">
                                        <div class="col-md-5 col-sm-5 col-12 form-group float-right top_search"
                                            style="margin: 15px;">
                                            <div class="float-right">
                                                <button type="button" style="" class="btn btn-new"
                                                    onclick="window.location.href='{{ route('land.create', 'realestate_id=' . $realestate->_id) }}'">
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
                @endif
                @if ($apModule->slug == 'showrooms')
                    <div class="col-12">
                        <div class="clp mt-4">
                            <h5>Showrooms
                                <span class="float-right">
                                    <button class="clp-toggler" type="button">Hide</button>
                                </span>
                            </h5>
                            <hr class="rounded form-horizontal-line">
                        </div><!-- /.clp -->
                        <div class="row clpc active" style="display: block;">
                            <div class="panel-body">
                                @php($showroom = new App\Models\Showroom())
                                <div class="tab-content">
                                    @php(
    $compacts = [
        'title' => $showroom->title,
        'fields' => $showroom->fields,
        'route' => route('showroom.index', 'realestate_id=' . $realestate->_id),
        'new' => route('showroom.create'),
    ]
)
                                    <div class="title_right">
                                        <div class="col-md-5 col-sm-5 col-12 form-group float-right top_search"
                                            style="margin: 15px;">
                                            <div class="float-right">
                                                <button type="button" style="" class="btn btn-new"
                                                    onclick="window.location.href='{{ route('showroom.create', 'realestate_id=' . $realestate->_id) }}'">
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
                @endif
            @endforeach
        @endif
        <div class="col-12">
            <div class="clp mt-4">
                <h5>Project Advantages
                    <span class="float-right">
                        <button class="clp-toggler" type="button">Hide</button>
                    </span>
                </h5>
                <hr class="rounded form-horizontal-line">
            </div><!-- /.clp -->
            <div class="row clpc active" style="display: block;">
                <div class="col-md-12 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                    <div class="form-group">
                        @include('cms.layouts.dynamic-inputs', [
                            'add' => 'Add Project Advantage',
                            'label' => 'Project Advantages',
                            'hidden' => 'advantage',
                            'inputs' => [
                                [
                                    'name' => 'advantage_names',
                                    'type' => 'text',
                                    'placeHolder' => 'Advantage Name',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'advantage_descriptions',
                                    'type' => 'ckeditor',
                                    'id' => '_object',
                                    'label' => 'Object',
                                    'placeHolder' => 'Description',
                                    'label' => 'Description',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'object_images',
                                    'type' => 'image',
                                    'id' => 'image',
                                    'label' => 'icon',
                                ],
                            ],
                            'values' => $realestate->advantage_values,
                        ])
                    </div>
                </div><!-- /.col-* -->
            </div><!-- /.row.clpc -->
        </div>

        <div class="col-12">
            <div class="clp mt-4">
                <h5>Surrounding The Project
                    <span class="float-right">
                        <button class="clp-toggler" type="button">Hide</button>
                    </span>
                </h5>
                <hr class="rounded form-horizontal-line">
            </div><!-- /.clp -->
            <div class="row clpc active" style="display: block;">
                <div class="col-md-12 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                    <div class="form-group">
                        @include('cms.layouts.dynamic-inputs', [
                            'add' => 'Add Surrounding',
                            'label' => 'Surrounding The Project',
                            'hidden' => 'surrounding',
                            'inputs' => [
                                [
                                    'name' => 'surrounding_names',
                                    'type' => 'text',
                                    'placeHolder' => 'Surrounding Name',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'surrounding_descriptions',
                                    'type' => 'ckeditor',
                                    'id' => '_object',
                                    'label' => 'Object',
                                    'placeHolder' => 'Description',
                                    'label' => 'Description',
                                    'required' => true,
                                ],
                                [
                                    'name' => 'surrounding_images',
                                    'type' => 'image',
                                    'id' => 'image',
                                    'label' => 'icon',
                                ],
                            ],
                            'values' => $realestate->surrounding_values,
                        ])
                    </div>
                </div><!-- /.col-* -->
            </div><!-- /.row.clpc -->
        </div>

        <div class="col-12">
            <div class="clp mt-4">
                <h5>Address
                    <span class="float-right">
                        <button class="clp-toggler" type="button">Hide</button>
                    </span>
                </h5>
                <hr class="rounded form-horizontal-line">
            </div><!-- /.clp -->
            <div class="row clpc active" style="display: block;">
                <div class="col-md-6">

                    <div class="col-md-12 mt-2" style="min-height: 60px;padding: 10px">

                        <div class="form-group" style="padding-top: 10px">
                            <input type="text" id="address-input" placeholder="Search..."
                                class="form-control map-input" value="">
                            <input type="hidden" name="address_latitude" id="address-latitude"
                                value="{{ $realestate->location[0] ?? '' }}" />
                            <input type="hidden" name="address_longitude" id="address-longitude"
                                value="{{ $realestate->location[1] ?? '' }}" />
                            {{-- @dd($realestate->address_points_string) --}}
                            @if (isset($realestate->address_points) and $realestate->address_points != null)
                                @php($address_points = str_replace(['"', ']', '['], '', json_encode($realestate->address_points)))
                            @else
                                @php($address_points = null)
                            @endif
                            <input type="hidden" name="address_points" id="address-points"
                                value="{{ $address_points ?? '' }}" />

                            <div id="address-map-container" style="width:100%;height:400px;position: relative; ">

                                <span id="delete-button" class="map-delete-btn">Delete Selected Shape</span>

                                <div style="width: 100%; height: 100%" id="address-map"></div>
                            </div>
                            <div id="info"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-12" for="address">Address<span class="required"
                                    style="color:red">*</span></label>
                            <div class="col-12">
                                <input type="text" id="address" name="address" required
                                    value="{{ $realestate->address }}" class="form-control col-12" />
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    </div><!-- /.col-* -->
                </div>
            </div><!-- /.row.clpc -->
        </div>


        <div class="col-12">
            <div class="clp mt-4">
                <h5>Gallery
                    <span class="float-right">
                        <button class="clp-toggler" type="button">Hide</button>
                    </span>
                </h5>
                <hr class="rounded form-horizontal-line">
            </div><!-- /.clp -->
            <div class="row clpc active" style="display: block;">

                <div class="row mt-md-4 mt-2">
                    <div class="col-12 pr-md-4 pl-md-4 ">
                        <label class="control-label col-12">Gallery realestate general photos (max 10
                            images)</label>
                        <div class="col-8 offset-md-2">
                            <div class="needsclick dropzone file-uploader" id="dz-documents"
                                data-route="{{ route('realestate.image-upload', $realestate->_id) }}"
                                data-route-remove="{{ route('realestate.image-remove', $realestate->_id) }}"
                                data-route-get="{{ route('realestate.images', $realestate->_id) }}" data-multiple="true"
                                data-max="10" data-name="gallery" data-files="">
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                </div><!-- /.row -->

            </div><!-- /.row.clpc -->
        </div><!-- /.col-* -->


        <div class="col-12">
            <div class="clp mt-4">
                <h5>Banners
                    <span class="float-right">
                        <button class="clp-toggler" type="button">Hide</button>
                    </span>
                </h5>
                <hr class="rounded form-horizontal-line">
            </div><!-- /.clp -->
            <div class="row clpc active" style="display: block;">

                <div class="row mt-md-4 mt-2">

                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                        <div class="form-group">
                            <div class="col-md-12">

                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="gallery_banner"><i class="fa fa-window-close"
                                        aria-hidden="true"></i></a>
                                <img class="image-display" id="src-gallery_banner"
                                    src="{{ $realestate->gallery_banner != null ? asset($realestate->gallery_banner) : asset('img/logo-placeholder.png') }}"
                                    alt="" />
                            </div>
                            <label class="control-label col-12" for="gallery_banner">gallery banner (
                                900x600
                                px )</label>
                            <div class="control-image-field col-12 d-flex flex-row">

                                <input type="hidden" id="hidden_gallery_banner" name="hidden_gallery_banner"
                                    value="{{ $realestate->gallery_banner != null ? 1 : 0 }}" />
                                <input type="file" id="gallery_banner" name="gallery_banner" value="{{ old('gallery_banner') }}"
                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                    class="input-file d-none" />
                                <span class="file-input-name-preview col-8"> </span>
                                <label class="upload-file-label col-3 offset-1" for="gallery_banner">Upload</label>
                            </div>
                        </div>
                    </div><!-- /.col-* -->

                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                        <div class="form-group">
                            <div class="col-md-12">

                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="guarantees_banner"><i class="fa fa-window-close"
                                        aria-hidden="true"></i></a>
                                <img class="image-display" id="src-guarantees_banner"
                                    src="{{ $realestate->guarantees_banner != null ? asset($realestate->guarantees_banner) : asset('img/logo-placeholder.png') }}"
                                    alt="" />
                            </div>
                            <label class="control-label col-12" for="guarantees_banner">guarantees banner (
                                900x600
                                px )</label>
                            <div class="control-image-field col-12 d-flex flex-row">

                                <input type="hidden" id="hidden_guarantees_banner" name="hidden_guarantees_banner"
                                    value="{{ $realestate->guarantees_banner != null ? 1 : 0 }}" />
                                <input type="file" id="guarantees_banner" name="guarantees_banner" value="{{ old('guarantees_banner') }}"
                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                    class="input-file d-none" />
                                <span class="file-input-name-preview col-8"> </span>
                                <label class="upload-file-label col-3 offset-1" for="guarantees_banner">Upload</label>
                            </div>
                        </div>
                    </div><!-- /.col-* -->

                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                        <div class="form-group">
                            <div class="col-md-12">

                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="gift_banner"><i class="fa fa-window-close"
                                        aria-hidden="true"></i></a>
                                <img class="image-display" id="src-gift_banner"
                                    src="{{ $realestate->gift_banner != null ? asset($realestate->gift_banner) : asset('img/logo-placeholder.png') }}"
                                    alt="" />
                            </div>
                            <label class="control-label col-12" for="gift_banner">gift banner (
                                900x600
                                px )</label>
                            <div class="control-image-field col-12 d-flex flex-row">

                                <input type="hidden" id="hidden_gift_banner" name="hidden_gift_banner"
                                    value="{{ $realestate->gift_banner != null ? 1 : 0 }}" />
                                <input type="file" id="gift_banner" name="gift_banner" value="{{ old('gift_banner') }}"
                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                    class="input-file d-none" />
                                <span class="file-input-name-preview col-8"> </span>
                                <label class="upload-file-label col-3 offset-1" for="gift_banner">Upload</label>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                        <div class="form-group">
                            <div class="col-md-12">

                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="features_banner"><i class="fa fa-window-close"
                                        aria-hidden="true"></i></a>
                                <img class="image-display" id="src-features_banner"
                                    src="{{ $realestate->features_banner != null ? asset($realestate->features_banner) : asset('img/logo-placeholder.png') }}"
                                    alt="" />
                            </div>
                            <label class="control-label col-12" for="features_banner">features banner (
                                900x600
                                px )</label>
                            <div class="control-image-field col-12 d-flex flex-row">

                                <input type="hidden" id="hidden_features_banner" name="hidden_features_banner"
                                    value="{{ $realestate->features_banner != null ? 1 : 0 }}" />
                                <input type="file" id="features_banner" name="features_banner" value="{{ old('features_banner') }}"
                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                    class="input-file d-none" />
                                <span class="file-input-name-preview col-8"> </span>
                                <label class="upload-file-label col-3 offset-1" for="features_banner">Upload</label>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2">
                        <div class="form-group">
                            <div class="col-md-12">

                                <a href="javascript:void(0)" class="remove-x remove-single-image"
                                    style="position:absolute;" data-id="advantages_banner"><i class="fa fa-window-close"
                                        aria-hidden="true"></i></a>
                                <img class="image-display" id="src-advantages_banner"
                                    src="{{ $realestate->advantages_banner != null ? asset($realestate->advantages_banner) : asset('img/logo-placeholder.png') }}"
                                    alt="" />
                            </div>
                            <label class="control-label col-12" for="advantages_banner">advantages banner (
                                900x600
                                px )</label>
                            <div class="control-image-field col-12 d-flex flex-row">

                                <input type="hidden" id="hidden_advantages_banner" name="hidden_advantages_banner"
                                    value="{{ $realestate->advantages_banner != null ? 1 : 0 }}" />
                                <input type="file" id="advantages_banner" name="advantages_banner" value="{{ old('advantages_banner') }}"
                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                    class="input-file d-none" />
                                <span class="file-input-name-preview col-8"> </span>
                                <label class="upload-file-label col-3 offset-1" for="advantages_banner">Upload</label>
                            </div>
                        </div>
                    </div><!-- /.col-* -->
                </div><!-- /.row -->

            </div><!-- /.row.clpc -->
        </div><!-- /.col-* -->

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
        ajaxSelect('projectCategory_id', 'ProjectCategory')
        ajaxSelect('salesStatus_id', 'SalesStatus')
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

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuBA_blyNZMwU-PgkI-ze6eVD1pNCuu9I&libraries=places,drawing&callback=initialize"
        async defer></script>

    <script type='text/javascript'>
        var app = @json($realestate);
        //console.log(app['address_points']);

        var all_overlays = [];
        var selectedShape;
        var polygonArray = [];
        var existingPolygon = null;

        function clearSelection() {
            if (selectedShape) {
                selectedShape.setEditable(false);
                selectedShape = null;
            }
        }

        function setSelection(shape) {
            clearSelection();
            selectedShape = shape;
            shape.setEditable(false);

        }

        function deleteSelectedShape() {
            if (selectedShape) {
                selectedShape.setMap(null);
                document.getElementById('address-points').value = ''
            }
            if (existingPolygon) {
                existingPolygon.setMap(null);
                document.getElementById('address-points').value = ''
            }
        }


        function initialize() {
            console.log("hello")
            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(
                    fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 24.68015824409239;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 46.66315286552702;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {
                        lat: latitude,
                        lng: longitude
                    },
                    zoom: 13
                });


                var propertyCoords = '';

                var drawingManager = null;
                var points_test = [];
                if (app['address_points'] != null && app['address_points'] != '') {
                    // console.log("is not empty")

                    for (var z = 0; z < app['address_points'].length; z++) {
                        points_test.push({
                            lat: parseFloat(app['address_points'][z][0]),
                            lng: parseFloat(app['address_points'][z][1])
                        });
                    }
                }
                if (typeof points_test !== 'undefined' && points_test != null && points_test != '') {
                    if (!google.maps.Polygon.prototype.getBounds) {
                        google.maps.Polygon.prototype.getBounds = function() {
                            var bounds = new google.maps.LatLngBounds();
                            this.getPath().forEach(function(element, _) {
                                bounds.extend(element);
                            });
                            return bounds;
                        };
                    }

                    /**
                     * used for tracking polygon bounds changes within the drawing manager
                     */
                    google.maps.Polygon.prototype.enableCoordinatesChangedEvent = function() {
                        var me = this,
                            isBeingDragged = false,
                            triggerCoordinatesChanged = function() {
                                //broadcast normalized event
                                google.maps.event.trigger(me, "coordinates_changed");
                            };

                        //if  the overlay is being dragged, set_at gets called repeatedly, so either we can debounce that or igore while dragging, ignoring is more efficient
                        google.maps.event.addListener(me, "dragstart", function() {
                            isBeingDragged = true;
                        });

                        //if the overlay is dragged
                        google.maps.event.addListener(me, "dragend", function() {
                            triggerCoordinatesChanged();
                            isBeingDragged = false;
                        });

                        //or vertices are added to any of the possible paths, or deleted
                        var paths = me.getPaths();
                        paths.forEach(function(path, i) {
                            google.maps.event.addListener(path, "insert_at", function() {
                                triggerCoordinatesChanged();
                            });
                            google.maps.event.addListener(path, "set_at", function() {
                                if (!isBeingDragged) {
                                    triggerCoordinatesChanged();
                                }
                            });
                            google.maps.event.addListener(path, "remove_at", function() {
                                triggerCoordinatesChanged();
                            });
                        });
                    };

                    function extractPolygonPoints(data) {
                        var MVCarray = data.getPath().getArray();

                        var to_return = MVCarray.map(function(point) {
                            return `(${point.lat()},${point.lng()})`;
                        });
                        // first and last must be same
                        return to_return.concat(to_return[0]).join(",");
                    }

                    existingPolygon = new google.maps.Polygon({
                        paths: points_test,
                        editable: false,
                        draggable: false,
                        map: map,
                        ...polyOptions
                    });
                    map.fitBounds(existingPolygon.getBounds());

                    existingPolygon.enableCoordinatesChangedEvent();

                    google.maps.event.addListener(existingPolygon, 'coordinates_changed', function() {
                        console.warn('coordinates changed!', extractPolygonPoints(existingPolygon))
                    });
                    // My guess is to use a conditional statement to check if the map has any coordinates saved?
                }

                var polyOptions = {
                    strokeWeight: 0,
                    fillOpacity: 0.45,

                    editable: false
                };
                drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: null,
                    drawingControl: true,
                    drawingControlOptions: {
                        position: google.maps.ControlPosition.TOP_CENTER,
                        drawingModes: [google.maps.drawing.OverlayType.POLYGON, ],
                        polygonOptions: polyOptions,

                        map: map
                    },

                });
                google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {

                    all_overlays.push(e);
                    if (e.type != google.maps.drawing.OverlayType.MARKER) {
                        // Switch back to non-drawing mode after drawing a shape.
                        drawingManager.setDrawingMode(null);

                        // Add an event listener that selects the newly-drawn shape when the user
                        // mouses down on it.
                        var newShape = e.overlay;
                        newShape.type = e.type;
                        google.maps.event.addListener(newShape, 'click', function() {
                            setSelection(newShape);

                        });
                        setSelection(newShape);
                    }

                });
                google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
                    // assuming you want the points in a div with id="info"
                    var arr = [];
                    for (var i = 0; i < polygon.getPath().getLength(); i++) {
                        arr.push(polygon.getPath().getAt(i).toUrlValue(6))
                    }

                    setPointsCoordinates(arr);
                });




                drawingManager.setMap(map);

                const marker = new google.maps.Marker({
                    draggable: true,
                    map: map,
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                });
                google.maps.event.addListener(marker, 'dragend', function(marker) {
                    var latLng = marker.latLng;
                    document.getElementById('address-latitude').value = latLng.lat();
                    document.getElementById('address-longitude').value = latLng.lng();
                });
                // google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
                // marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({
                    input: input,
                    map: map,
                    marker: marker,
                    autocomplete: autocomplete
                });
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({
                        'placeId': place.place_id
                    }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);

                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
            //google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
            google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape)
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }

        function setPointsCoordinates(pt) {
            const longitudeField = document.getElementById("address-points");
            longitudeField.value = pt;
        }
    </script>
@endpush
