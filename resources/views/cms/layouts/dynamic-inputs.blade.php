@php($uId = uniqid())
{{-- @dd($values) --}}
<div class="item form-group">
    <label class="col-sm-2 col-xs-2">{{ $label }}</label>
    <div class="container">
        <div class="col-md-12 dynamic-inputs">
            @if (isset($values) and count($values) > 0)
                @foreach ($values as $value)
                    <div class="inline-inputs">
                        @foreach ($value as $val)
                            @if ($inputs[$loop->index]['type'] == 'select')
                                <select class="select2_{{ $uId }}" name="{{ $inputs[$loop->index]['name'] }}[]"
                                    @if (isset($inputs[$loop->index]['required']) and $inputs[$loop->index]['required']) required="required" @endif>
                                    @if (Arr::has($inputs[$loop->index], 'options'))
                                        @foreach ($inputs[$loop->index]['options'] as $opt)
                                            <option value="{{ $opt->id }}"
                                                @if ($opt->id == $val['_id']) selected @endif>{{ $opt->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($inputs[$loop->index]['custom_options'] as $opt)
                                            <option value="{{ $opt['value'] }}"
                                                @if ($opt['value'] == $val) selected @endif>{{ $opt['name'] }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            @elseif($inputs[$loop->index]['type'] == 'ckeditor')
                                @php($ckId = uniqid())
                                <div class="item form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12 mt-2" style="padding: 0;">
                                        <textarea id="{{ $ckId }}" name="{{ $inputs[$loop->index]['name'] }}[]"
                                            class="form-control col-md-12 col-xs-12 ckeditor" placeholder="{{ $inputs[$loop->index]['placeHolder'] }}">{!! $val ?: '' !!}</textarea>
                                    </div>
                                </div>
                                {{-- <script>CKEDITOR.replace({{$ckId}});</script> --}}
                            @elseif($inputs[$loop->index]['type'] == 'image')
                                @php( $imId = uniqid())
                                <div class="item form-group">
                                    <div class="col-md-12">
                                        
                                        <a href="javascript:void(0)" class="remove-x remove-single-image"
                                        style="position:absolute;" data-id="{{ $inputs[$loop->index]['name'].'_'.$imId }}"><i class="fa fa-window-close"
                                            aria-hidden="true"></i></a>
                                        <img class="image-display src-{{ $inputs[$loop->index]['name'].'_'.$imId }}" id="src-{{ $inputs[$loop->index]['name'].'_'.$imId }}"
                                            src="{{ $val != null ? asset($val) : asset('img/logo-placeholder.png') }}"
                                            alt="" />
                                    </div>
                                    <div class="control-image-field col-12 d-flex flex-row">
                                        <input type="hidden" id="hidden_{{ $inputs[$loop->index]['name'].'_'.$imId }}" name="hidden_{{ $inputs[$loop->index]['name'].'_'.$imId }}"
                                        value="{{ $val != null ? 1 : 0 }}" />
                                        <input type="hidden"  name="{{ $hidden }}_hidden_val[]" value="hidden_{{$inputs[$loop->index]['name'].'_'.$imId }}" />
                                        <input type="file" id="{{ $inputs[$loop->index]['name'].'_'.$imId }}" name="{{ $inputs[$loop->index]['name']}}[]" value="{{ old('image') }}"
                                            onchange="readURL(this,$(this).parent().parent().find('.src-{{ $inputs[$loop->index]['name'].'_'.$imId }}'));"
                                            class="input-file d-none" />
                                        <span class="file-input-name-preview col-8"> </span>
                                        <label class="upload-file-label col-3 offset-1" for="{{ $inputs[$loop->index]['name'].'_'.$imId }}">Upload</label>
                                    </div>
                                </div>
                            @else
                                <input type="{{ $inputs[$loop->index]['type'] }}" class="form-control col-md-12 mt-2"
                                    name="{{ $inputs[$loop->index]['name'] }}[]"
                                    placeholder="{{ $inputs[$loop->index]['placeHolder'] }}"
                                    value="{{ $val }}"
                                    @if (isset($inputs[$loop->index]['required']) and $inputs[$loop->index]['required']) required="required" @endif>
                            @endif
                        @endforeach
                        <div class="delete-input" onclick="$(this).parent().remove();">-</div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-12 add-input add-input_{{ $uId }}">
            <div class="plus">+</div><span>{{ $add }}</span>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(function() {
            $('.select2_{{ $uId }}').select2({
                width: '100%'
            });
        })
        $('.add-input_{{ $uId }}').on('click', function() {
            var div = '<div class="inline-inputs">';
            var id = '{{ $uId }}';
            var ckId = Math.floor(Math.random() * Math.floor(1000));

            var randNum = function() {
                return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
            };
            var counter = randNum();

            @foreach ($inputs as $input)
                @if ($input['type'] == 'select')
                    div +=
                        '<select class="select2_' + id +
                        '" name="{{ $input['name'] }}[]" @if (isset($inputs[$loop->index]['required']) and $inputs[$loop->index]['required']) required="required" @endif>' +
                        '<option value="">Select</option>' +
                        @if (Arr::has($input, 'options'))

                            @foreach ($input['options'] as $opt)
                                '<option value="{{ $opt->id }}">{{ $opt->name }}</option>' +
                            @endforeach
                        @else
                            @foreach ($input['custom_options'] as $opt)
                                '<option value="{{ $opt['value'] }}">{{ $opt['name'] }}</option>' +
                            @endforeach
                        @endif

                    '</select>';
                @elseif ($input['type'] == 'image')
                    div += '<div class="item form-group">\n' +
                        '<div class="col-md-12">\n' +
                        '<a href="javascript:void(0)" class="remove-x remove-single-image1" onclick=removeSingle("{{ $inputs[$loop->index]['name'] }}-' +
                        ckId + '")\n' +
                        'style="position:absolute;" data-id="{{ $inputs[$loop->index]['name'] }}-' + ckId +
                        '"><i class="fa fa-window-close"\n' +
                        'aria-hidden="true"></i></a>\n' +
                        '<img class="image-display src-{{ $inputs[$loop->index]['name'] }}-' + ckId +
                        '" id="src-{{ $inputs[$loop->index]['name'] }}-' + ckId + '"\n' +
                        'src="{{ asset('img/logo-placeholder.png') }}" alt="" /></div> \n' +

                        '<div class="control-image-field col-12 d-flex flex-row"> \n' +
                        '<input type="hidden" id="hidden_{{ $inputs[$loop->index]['name'] }}-' + ckId +
                        '" name="hidden_{{ $inputs[$loop->index]['name'] }}-' + ckId +
                        '" \n' +
                        'value="{{ 0 }}" /> \n' +
                        
                        '<input type="hidden"  name="{{ $hidden }}_hidden_val[]" value="hidden_{{ $inputs[$loop->index]['name'] }}-' + ckId +'" /> \n' +
                        '<input type="file" id="{{ $inputs[$loop->index]['name'] }}-' + ckId +
                        '" name="{{ $inputs[$loop->index]['name'] }}[]" \n' +
                        'onchange=readURL1(this,$(this).parent().parent().find(".src-{{ $inputs[$loop->index]['name'] }}-' +
                        ckId + '")); \n' +
                        'class="input-file d-none" /> \n' +
                        '<span class="file-input-name-preview col-8"> </span> \n' +
                        '<label class="upload-file-label col-3 offset-1" for="{{ $inputs[$loop->index]['name'] }}-' +
                        ckId + '">Upload</label> \n' +
                        '</div> \n' +
                        '</div>';
                @elseif ($input['type'] == 'ckeditor')
                    div += '<div class="item form-group">\n' +
                        '<div class="col-md-12 col-sm-6 col-xs-12 mt-2" style="padding: 0;">\n' +
                        '<textarea id="' + ckId +
                        '_ck" name="{{ $input['name'] }}[]" class="form-control col-md-12 col-xs-12 ckeditor" placeholder="{{ $input['placeHolder'] }}"></textarea></div></div>';
                @else
                    div +=
                        '<input type="{{ $input['type'] }}" class="form-control col-md-12 mt-2" name="{{ $input['name'] }}[]" placeholder="{{ $input['placeHolder'] }}" @if (Arr::has($input, 'default')) value={{ $input['default'] }} @endif @if (isset($inputs[$loop->index]['required']) and $inputs[$loop->index]['required']) required="required" @endif>'
                @endif
            @endforeach
            div += '<div class="delete-input" onclick="$(this).parent().remove();">-</div>';
            div += '</div>';

            $parentDiv = $(this).parent().find('.dynamic-inputs');
            $parentDiv.append(div);

            $('.select2_' + id).select2({
                width: '100%'
            });
            CKEDITOR.replace(ckId + '_ck');
        })

        function readURL1(input, preview) {
            // console.log(preview);
            var id = input.id;
            document.getElementById('hidden_' + id).value = 1
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // console.log(e.target.result)
                    preview.show()
                    preview.attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeSingle(id) {
            document.getElementById('hidden_' + id).value = 0
            document.getElementById('src-' + id).src = '{{ asset('img/logo-placeholder.png') }}'
            clearFileInput(document.getElementById(id));
        }

        function clearFileInput1(ctrl) {
            try {
                ctrl.value = null;
                console.log(ctrl)
            } catch (ex) {}
            if (ctrl.value) {
                ctrl.parentNode.replaceChild(ctrl.cloneNode(true), ctrl);
            }
        }
    </script>
@endpush
