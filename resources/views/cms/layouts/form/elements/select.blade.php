<div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
<div class="form-group">
    <label class="control-label col-12" for="last-name">{{ $label }}
        {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}
    </label>
    <div class="col-12">
        <select @if($isShow != 0) readonly="true" disabled @endif class="select2 select2-without-ajax"
                name="{{ $name }}@if(isset($multiple) and $multiple)[]@endif" id="{{ $id }}"
                @if(isset($multiple) and $multiple) multiple @endif>
                @if(isset($withoutChooseOption) and $withoutChooseOption)
                    <option value="">Choose {{ Str::singular($label) }}</option>
                @endif
            @if(!is_array($options))
                @foreach($options as $option)
                    <option value="{{ $option->{$valueMember} }}"
                            @if(isset($value) && !is_array($value) &&  $option->{$valueMember} == $value) selected
                            @elseif(isset($value) && is_array($value) &&  in_array($option->{$valueMember},$value))selected
                        @endif>
                        {{ $option->display ?? $option->{$displayMember} }}
                    </option>
                @endforeach
            @else
                @foreach($options as $key => $display)
                    <option value="{{ $key }}"
                            @if(isset($value) &&  $key == $value) selected @endif>{{ $display }}</option>
                @endforeach
            @endif
        </select>
        @error($name)
        <span style="color:red">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>
</div>
