@extends('cms.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Registration</h2>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->
                <div class="row">
                    <form method="POST" action="{{route('registration.update',$registration->id)}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="col-md-10 col-sm-12 offset-md-2">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-12 col-xs-12" for="text">
                                    Text
                                </label>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                      <textarea class="form-control" id="text" name="text" rows="25"
                                                required="required">{{$registration->text}}</textarea>
                                </div><!-- /.col-* -->
                            </div><!-- /.form-group -->
                        </div><!-- /.col-* -->
                        <div class="form-group">
                            <div class="col-md-2 col-sm-3 col-xs-12 col-md-offset-10">
                                <button type="submit" class="btn btn-success btn-submit-model">
                                    Edit
                                </button>
                            </div><!-- /.col-* -->
                        </div><!-- /.form-group -->
                    </form>
                </div><!-- /.row -->
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection

