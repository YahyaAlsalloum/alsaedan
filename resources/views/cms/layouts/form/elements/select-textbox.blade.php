<div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
<div class="form-group">
    <label class="control-label col-12" for="last-name">{{ $label }}
        {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}
    </label>
    <div class="col-12">
        <select @if($select['isShow'] != 0) readonly="true" disabled @endif class="select2"
                name="{{ $select['name'] }}@if(isset($select['multiple']) and $select['multiple'])[]@endif"
                id="{{ $select['id'] }}"
                @if(isset($select['multiple']) and $select['multiple']) multiple @endif>
            @if(isset($select['withoutChooseOption']) and $select['withoutChooseOption'])
                <option value="">Choose {{ Str::singular($select['label']) }}</option>
            @endif
            @if(!is_array($select['options']))
                @foreach($select['options'] as $option)
                    <option value="{{ $option->{$valueMember} }}"
                            @if(isset($select['value']) && !is_array($select['value']) &&
                            $option->{$valueMember} == $select['value']) selected
                            @elseif(isset($select['value']) && is_array($select['value']) &&
                            in_array($option->{$valueMember},$select['value']))selected
                        @endif>
                        {{ $option->display ?? $option->{$displayMember} }}
                    </option>
                @endforeach
            @else
                @foreach($select['options'] as $key => $display)
                    <option value="{{ $key }}"
                            @if(isset($value) &&  $key == $value) selected @endif>{{ $display }}</option>
                @endforeach
            @endif
        </select>
        @error($select['name'])
        <span style="color:red">
        {{ $select['message'] }}
        </span>
        @enderror
    </div>
    <div class="col-12">
        <input type="{{ $text['type'] }}" id="{{ $text['id'] }}" name="{{ $text['name'] }}"
               {{ $isRequired == "true" ? " required" : " " }}
               value="{{ isset($text['value']) ? $text['value'] : old($text['name']) }}"
               @if($text['isShow'] != 0) readonly="true" disabled @endif
               class="form-control col-12 @isset($text['classes']) {{ $text['classes'] }} @endisset ">
        @error($text['name'])
        <span style="color:red">
                    {{ $text['message'] }}
                </span>
        @enderror
    </div>
</div>
</div>
