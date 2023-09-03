<div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
<div class="form-group">
    <label class="control-label col-12" for="last-name">{{ $label }}
        {!!  $isRequired ? '<span class="required" style="color:red">*</span>' :  '' !!}
    </label>
    <div class="col-12">
        <select @if($isShow != 0) readonly="true" disabled @endif class="select2 select2-ajax"
                name="{{ $name }}@if(isset($multiple) and $multiple)[]@endif" id="{{ $id }}"
                data-route ="{{route('select.ajax',$model)}}"
                data-name ="{{$name}}"
                @if(isset($multiple) and $multiple) multiple @endif>

                @isset($values)
                    @foreach($values as $key => $value)
                            <option value="{{$key}}" selected>{{$value}}</option>
                    @endforeach
                @endisset

        </select>
        @error($name)
        <span style="color:red">
        {{ $message }}
        </span>
        @enderror
    </div>
</div>
</div>
<script>
    ajaxSelect('{{$id}}','{{$name}}')
</script>
