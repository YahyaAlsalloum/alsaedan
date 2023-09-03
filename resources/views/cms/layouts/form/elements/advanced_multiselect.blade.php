<div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
<div class="form-group">
    <label class="control-label col-12" for="last-name">{{ $label }}
        {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}
    </label>
    <div class="col-12">
        <select multiple="multiple" id="{{ $id }}" name="{{ $name }}[]" @if($isShow != 0) readonly="true" disabled
                @endif class="form-control">

            @foreach($options as $option)
                <option value="{{ $option->{$valueMember} }}"
                        @if(isset($value) && is_array($value) &&  in_array($option->{$valueMember},$value))selected
                    @endif>
                    {{ $option->{$displayMember} }}
                </option>
            @endforeach
        </select>
        @error($name)
        <span style="color:red">
            {{ $message }}
        </span>
        @enderror
    </div>
</div>
</div>
