@php($imId = uniqid('image'))
<div class="item form-group">
    <label class="control-label col-sm-2 col-xs-12" for="{{$name}}">{{__('cms.'.str_slug($label))}} @if(isset($required) and
        $required)<span class="required">*</span> @endif
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        @if(isset($value) and $value != null)
            <div class="input-image show @if(isset($icon) and $icon) icon-image @endif">
                <img src="{{(str_contains($value, 'graph.facebook') or
                 str_contains($value, 'googleusercontent'))? $value : asset($value)}}"
                     id="{{$imId.'_'.$name}}-display"/>
                <a href="javascript:void(0)" class="image-fav delete-object-image" data-id="{{$imId.'_'.$name}}"
                   data-route="{{$route}}"><img src="{{asset("images/deletemodifypic.png")}}"> </a>
            </div>
        @else
            <div class="input-image @if(isset($icon) and $icon) icon-image @endif">
                <img src="" id="{{$imId.'_'.$name}}-display"/>
                <a href="javascript:void(0)" class="image-fav delete-selected-image" data-id="{{$imId.'_'.$name}}">
                    <img src="{{asset("images/deletemodifypic.png")}}"> </a>
            </div>
        @endif
        <div class="image-input-box">
            <a href="javascript:void(0)" class="popup_selector" data-inputid="{{$imId.'_'.$name}}"
               data-type="image">{{__('cms.browse_image')}}</a>
            <input type="text" id="{{$imId.'_'.$name}}" placeholder="@isset($placeholder){{$placeholder}}@endisset "name="{{$name}}@isset($multiple)[]@endisset" value="@isset($value){{$value}}@endisset"
                   readonly @isset ($error) data-error-message="{{$error}}" @endisset >
        </div>
    </div>
</div>

