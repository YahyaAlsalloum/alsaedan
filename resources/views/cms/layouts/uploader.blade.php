@extends('cms.layouts.app')

@section('content')

<body>


<div class="container-fluid">
    <div class="col-md-12 padding-0">
        <div class="page-title">
            <div class="title_left">
                <h2><b>{{ "CSV" }}</b></h2>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <form action="{{route('cms.uploader')}}" method="post" enctype="multipart/form-data">
                @csrf   
                    <div class="col-md-8 col-sm-12 offset-md-2">
                        
                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-12 col-xs-12" for="collection_name">
                                    Name
                            </label>
                            <div class="col-md-9 col-sm-12 col-xs-12">           
                                <input type="text" class="form-control col-md-12 col-xs-12 " name="collection_name"
                                placeholder="Collection Name( table name )" required>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-12 col-xs-12" for="collection_fields">
                                    Collection Fields
                            </label>
                            <div class="col-md-9 col-sm-12 col-xs-12">           
                            <input type="text" class="form-control col-md-12 col-xs-12 "
                            name="collection_fields" placeholder="Collection Fields separated by , in the same order of csv file " required>
                        
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->

                        <div class="form-group row">
                            <label class="control-label col-md-3 col-sm-12 col-xs-12" for="csv_file">
                                    Csv File
                            </label>
                            <div class="col-md-9 col-sm-12 col-xs-12">           
                                <input type="file" class="col-md-12 col-xs-12 " name="csv_file" required>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    
                        <br/>
                        {{-- <input type="submit" name="Export" > --}}
                        <div class="form-group" style="text-align: right;">
                            <button type="submit" class="btn btn-success btn-submit-model">
                                    Save
                            </button>
                        </div><!-- /.form-group -->
                </div>
            </form>
        </div>
    </div>
</div>

@endsection