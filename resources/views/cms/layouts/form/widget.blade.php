<form method="POST" id="form"
      @if($isShow == 0) action="{{$action}}" @endif
      data-parsley-validate="" class="form-horizontal form-label-left"
      novalidate enctype="multipart/form-data">
    @if($isShow == 0)
        @csrf
        @method($method)
    @endif
    {!! $elements !!}
    {{--    <input type='hidden' value='' name='order' id='hdn'>--}}
    @if($isShow == 0)
{{--        <div class="ln_solid"></div>--}}

{{--        <div class="form-group">--}}
{{--            <div class="col-md-6 col-sm-6 col-12 offset-md-3">--}}
{{--                <button id="reset" class="btn btn-primary" type="reset">Reset</button>--}}
{{--                <button type="submit"--}}
{{--                        class="btn btn-success btn-submit-model">--}}
{{--                    {{(!$forPublishing) ? 'Submit' : 'Publish'}}</button>--}}
{{--            </div>--}}
{{--        </div>--}}
</form>
@endif
