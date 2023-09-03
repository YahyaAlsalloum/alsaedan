@extends('cms.layouts.app')
@push('css')
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Branch Locations</h2>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->
                <div class="row">
                    <form method="POST" action="{{route('siteMap.update',$siteMap->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <h4 class="control-label col-md-12" style="text-align: left;">Branch Locations</h4>
                                <div class="col-md-12">
                                    <div id="locations" class="row">
                                        <div id="locations-box" class="col-md-9 offset-md-2"></div>
                                        <div class="col-md-12">
                                            <div class="btn btn-primary  mb-2" onclick="addLocation()">Add Number</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.col-* -->
                        <div class="form-group">
                            <div class="col-md-2 col-sm-3 col-xs-12 col-md-offset-10">
                                <button type="submit" class="btn btn-success btn-submit-model">
                                    Update
                                </button>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    </form>
                </div><!-- /.row -->
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
{{--    @include('admin.layouts.form.javascript')--}}
    <script>
        function addLocation() {
            let counter = parseInt(Math.random() * 1000);
            let div = '<div class="col-md-9">\n' +
                '<div id="' + counter + '" class="row">\n' +
                '<div id="locations-box-' + counter + '" class="col-md-12"></div>\n' +
                '<div class="col-md-4" style="margin-top:20px"><input type="text" placeholder="name" class="form-control"' +
                'name="siteMap_name[\'' + counter + '\']"/><br/></div>' +
                '<div class="col-md-4" style="margin-top:20px"><input type="text" placeholder="longitude" class="form-control"' +
                'name="siteMap_long[\'' + counter + '\']"/><br/></div>' +
                '<div class="col-md-4" style="margin-top:20px"><input type="text" placeholder="latitude" class="form-control"' +
                'name="siteMap_lat[\'' + counter + '\']"/><br/>' +
                '<div class="btn btn-primary float-right" onclick="$(this).parent().parent().parent().remove()">remove</div></div>\n' +
                '</div><br/><br/>\n' +
                '</div>';

            $('#locations-box').append(div);
        }
        var container = "";
        @foreach($siteMap->siteMaps as $siteMap)
            container = preselectedLocations('{{$siteMap['siteMap_name']}}', '{{$siteMap['siteMap_long']}}', '{{$siteMap['siteMap_lat']}}')
        @endforeach

        function preselectedLocations(siteMap_name, siteMap_long, siteMap_lat) {
            let counter = parseInt(Math.random() * 1000);
            let div = '<div class="col-md-9">\n' +
                '<div id="' + counter + '" class="row">\n' +
                '<div id="locations-box-' + counter + '" class="col-md-12"></div>\n' +
                '<div class="col-md-4" style="margin-top:20px"><input type="text" placeholder="Branch Name" class="form-control"' +
                'name="siteMap_name[\'' + counter + '\']" value="' + siteMap_name + '"/><br/></div>' +
                '<div class="col-md-4" style="margin-top:20px"><input type="text" placeholder="longitude" class="form-control"' +
                'name="siteMap_long[\'' + counter + '\']" value="' + siteMap_long + '"/><br/></div>' +
                '<div class="col-md-4" style="margin-top:20px"><input type="text" placeholder="latitude" class="form-control"' +
                'name="siteMap_lat[\'' + counter + '\']" value="' + siteMap_lat + '"/><br/>' +
                '<div class="btn btn-primary float-right" onclick="$(this).parent().parent().parent().remove()">remove</div></div>\n' +
                '</div><br/><br/>\n' +
                '</div>';

            $('#locations-box').append(div);
            return counter;
        }

        function goBack() {
            window.history.back();
        }

    </script>
@endpush

