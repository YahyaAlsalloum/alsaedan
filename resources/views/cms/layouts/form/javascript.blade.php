<script>
    $(function () {

        var k = "";

        function rgb2hex(rgb) {
            rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
            return (rgb && rgb.length === 4) ? "#" +
                ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
                ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : '';
        }

        $('.btn-submit-model').on('click', function (e) {
            if (typeof $('.colorpicker').val() !== "undefined") {
                if ($('.colorpicker').val().indexOf('#') == -1) {
                    var hex = rgb2hex($('.colorpicker').val());
                    $('.colorpicker').val(hex);
                }
            }
            if (typeof $('#hdn').val() !== "undefined")
                $('#hdn').val(k);

        });
    });
    function goBack() {
        window.history.back();
    }

    

    function ajaxSelect(id,title, query = null) {
        let route = $('#' + id).attr('data-route');
        let name = $('#' + id).attr('data-name');
        let value = $('#' + id).attr('data-value');
        if ($('#' + id).attr('data-flag') !== undefined) {
            let flag = $('#' + id).attr('data-search');
            route = route + '?search=' + flag;
        }
        if (query != null) {
            route += route.includes("?") ? ("&" + query) : ("?" + query)
        }
        $('#' + id).select2({
            width: '100%',
            placeholder: title,
            allowClear: true,
            closeOnSelect: false,
            ajax: {
                url: route,
                dataType: 'json',
                processResults: function (data) {
                    results = [];

                    // results.push({id: "", text:name})

                    data = $.map(data, function (obj) {
                        if ( name.includes(',')){
                            let v = '';
                            name.split(',').forEach(function(item){
                               if ( v === ''){
                                   v+= obj[item];
                               } else{
                                   v+= " - " + obj[item] ;
                               }
                            });
                            return {id: obj[value], text: v};
                        }
                        return {id: obj[value], text: obj[name]};
                    })
                    $.each(data, function (key, value) {
                        results.push(value)
                    })
                    return {
                        results: results
                    };
                },
                error: function (data) {
                    console.log(data)
                },
                cache: true
            }
        });

    }
</script>
<script>
    Dropzone.autoDiscover = false;
    $('.file-uploader').each(function(key, value){
        let route = $(value).attr('data-route');
        let routeRemove = $(value).attr('data-route-remove');
        let routeGet = $(value).attr('data-route-get');
        let multiple = $(value).attr('data-multiple');
        let max = $(value).attr('data-max');
        var uploadedDocumentMap = {}
        var options = Dropzone.options.documentDropzone = {
            url: route,
            maxFilesize: 20, // MB
            parallelUploads:1,
            uploadMultiple:true,
            maxFiles: multiple?max:1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                // $('form').append('<input type="hidden" name="'+divname+(multiple?'[]':'')+'" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {

                $.ajax({
                    type: 'POST',
                    url: routeRemove,
                    data: {
                        _token : "{{ csrf_token() }}",
                        file : file.name,
                    },
                    dataType:'json',

                }).done(function (result)
                {
                    if ( result ){
                        value.dropzone.options.maxFiles = max - myDropzone.files.length;
                        file.previewElement.remove()
                    }

                }).fail(function (data) {

                });
            },
            init: function () {
                // function createThumbnail(temp) {
                //
                // }
                $.ajax({
                    type: 'GET',
                    url: routeGet,
                    data: {
                        _token : "{{ csrf_token() }}",
                    },
                    dataType:'json',

                }).done(function (result)
                {
                    value.dropzone.options.maxFiles = max - result.length;
                    for(let i =0 ;i < result.length; i++){
                        var mockFile = {name : result[i].name ,
                            size: result[i].size, type: result[i].type,
                            dataURL: '{{asset('/')}}'+result[i].url};


                        myDropzone.files.push(mockFile);

                        //
                        //
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, '{{asset('/')}}'+result[i].url);
                        myDropzone.emit("complete", mockFile);
                    }
                }).fail(function (data) {

                });
            }
        }

        var myDropzone = new Dropzone(value,options );

    });

    function preview_image(event,identifier) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('image-holder'+identifier);
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    ;(function() {
        var inputs = document.querySelectorAll( '.input-file' );
        Array.prototype.forEach.call( inputs, function( input ) {
            var span = input.nextElementSibling
            input.addEventListener( 'change', function( e ) {
                fileName = e.target.value.split( '\\' ).pop();
                if( fileName )
                    span.innerHTML = fileName;
            });
            input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
            input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
        });
    })();

    function readURL(input,preview) {
        
            var id = input.id;
            document.getElementById('hidden_'+id).value = 1
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.show()
                preview.attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
