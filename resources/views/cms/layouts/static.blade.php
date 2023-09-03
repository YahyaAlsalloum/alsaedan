@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>{{$title}}</h5>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="sport-edit-form">save</button>
                            <button class="admin-form-close-btn">close</button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->
                <form id="sport-edit-form" method="POST" action="{{route('putStatic',$type)}}"
                      class="form-horizontal form-label-left"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <textarea class="form-control" name="{{$name}}" style="min-height: 500px" required="true"> {!! $value !!}</textarea>
                        </div>
                    </div><!-- /.row -->
                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    <script src="https://cdn.tiny.cloud/1/g4pej47ncrdxjq8dkkxcwrhkc8dp75xlvhf75i42hxfs7tyy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
@endpush
