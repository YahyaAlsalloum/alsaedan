@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Business Project Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="business-project-details-form-store">submit</button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>

                            <button class="admin-form-close-btn" onclick="window.location.href='{{ route('business-project.index') }}'">close</button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form method="POST" id="business-project-details-form-store" action="{{route('business-project.store')}}" class="form-horizontal form-label-left"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Overview
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div>
                            <div class="row clpc active" style="display: block;">

                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="name">Business Project Name<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <input type="text" id="name" name="name" required value="{{old('name')}}"
                                                   class="form-control col-12"/>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="status_id">Status<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax"
                                                    id="status_id"
                                                    data-route="{{route('select.ajax','Status')}}"
                                                    data-name="name"
                                                    data-value="_id"
                                                    onchange="ajaxSelect('status_id','Status')"
                                                    name="status_id"
                                                    required>
                                                @if(old('status_id') != null)
                                                    <option value="{{old('status_id')}}" selected>
                                                        {{\App\Models\Status::find(old('status_id'))->name}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="businessCategory_id">Business Category<span class="required" style="color:red">*</span></label>
                                        <div class="col-12">
                                            <select class="select2 select2-ajax"
                                                    id="businessCategory_id"
                                                    data-route="{{route('select.ajax','BusinessCategory')}}"
                                                    data-name="name"
                                                    data-value="_id"
                                                    onchange="ajaxSelect('businessCategory_id','BusinessCategory')"
                                                    name="businessCategory_id"
                                                    required>
                                                @if(old('businessCategory_id') != null)
                                                    <option value="{{old('businessCategory_id')}}" selected>
                                                        {{\App\Models\BusinessCategory::find(old('businessCategory_id'))->name}}
                                                    </option>
                                                @endif
                                            </select>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                <div class="col-lg-12 pr-md-12 pl-md-12 p-0 mt-md-12 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="description">description</label>
                                        <div class="col-12">
                                            <textarea class="col-md-12 form post-text" name="description"></textarea>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                
                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="building_area">Building Area</label>
                                        <div class="col-12">
                                            <input type="text" id="building_area" name="building_area" value="{{old('building_area')}}"
                                                   class="form-control col-12"/>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                  
                                <div class="col-lg-6 pr-md-6 pl-md-6 p-0 mt-md-6 mt-2" style="min-height: 60px">
                                    <div class="form-group">
                                        <label class="control-label col-12" for="land_area">Land area</label>
                                        <div class="col-12">
                                            <input type="text" id="land_area" name="land_area" value="{{old('land_area')}}"
                                                   class="form-control col-12"/>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-* -->
                                  
                                <div class="col-lg-12 p-0 mt-md-4 mt-2 mb-5" style="min-height: 60px">
                                    <div class="form-group">
                                        @include('cms.layouts.dynamic-inputs', [
                                            'add' => 'Add Unit',
                                            'label' => 'Units',
                                            'hidden' => 'units',
                                            'inputs' => [
                                                [
                                                    'name' => 'unit_names',
                                                    'type' => 'text',
                                                    'placeHolder' => 'Unit Name',
                                                    'required' => true,
                                                ],
                                                [
                                                    'name' => 'unit_numbers',
                                                    'type' => 'number',
                                                    'placeHolder' => 'Number',
                                                    'required' => true,
                                                ],
                                            ],
                                        ])
                                    </div>
                                </div><!-- /.col-* -->

                                <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                            style="position:absolute;" data-id="image"><i class="fa fa-window-close"
                                            aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-image"
                                                    src="{{asset('img/logo-placeholder.png')}}"
                                                    alt=""/>
                                        </div>
                                        <label class="control-label col-12" for="image">Business Project Image Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">
                                            
                                            <input type="hidden" id="hidden_image" 
                                            name="hidden_image"  
                                            value="{{0}}"/>
                                            <input type="file" id="image" name="image" value="{{old('image')}}"
                                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                    class="input-file d-none"/>
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1"
                                                    for="image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                                <div class="col-md-6 col-12 pr-md-4 pl-md-4 p-0">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            
                                            <a href="javascript:void(0)" class="remove-x remove-single-image"
                                            style="position:absolute;" data-id="cover_image"><i class="fa fa-window-close"
                                            aria-hidden="true"></i></a>
                                            <img class="image-display" id="src-cover_image"
                                                    src="{{asset('img/logo-placeholder.png')}}"
                                                    alt=""/>
                                        </div>
                                        <label class="control-label col-12" for="cover_image">Business Project Cover Photo ( 900x600
                                            px )</label>
                                        <div class="control-image-field col-12 d-flex flex-row">
                                            
                                            <input type="hidden" id="hidden_cover_image" 
                                            name="hidden_cover_image"  
                                            value="{{0}}"/>
                                            <input type="file" id="cover_image" name="cover_image" value="{{old('cover_image')}}"
                                                    onchange="readURL(this,$(this).parent().parent().find('.image-display'));"
                                                    class="input-file d-none"/>
                                            <span class="file-input-name-preview col-8"> </span>
                                            <label class="upload-file-label col-3 offset-1"
                                                    for="cover_image">Upload</label>
                                        </div>
                                    </div>
                                </div><!-- /.col-* -->
                            </div><!-- /.row -->
                        </div><!-- /.col-* -->
                        
                        
                        
                        <div class="col-12">
                            <div class="clp mt-4">
                                <h5>Address
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="col-md-12">
                                    <div class="col-md-6">

                                        <div class="col-md-12 mt-2" style="min-height: 60px">
                                            
                                            
                                            <div class="form-group" style="padding: 10px">
                                                <input type="text" id="address-input" placeholder="Search..."
                                                    class="form-control map-input" value="">
                                                <input type="hidden" name="address_latitude" id="address-latitude"
                                                    value=""/>
                                                <input type="hidden" name="address_longitude" id="address-longitude"
                                                    value=""/>
                                                <input type="hidden" name="address_points" id="address-points"
                                                value="" />
                                                <div id="address-map-container" style="width:100%;height:400px;position: relative; ">
                                                    <span id="delete-button" class="map-delete-btn" >Delete Selected Shape</span>
                                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-12" for="address_title">Address Title<span
                                                    class="required" style="color:red">*</span></label>
                                                <div class="col-12">
                                                    <input type="text" id="address_title" name="address_title" required value="{{old('address_title')}}"
                                                           class="form-control col-12"/>
                                                </div><!-- /.col-* -->
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label class="control-label col-12" for="address">Address<span
                                                    class="required" style="color:red">*</span></label>
                                                <div class="col-12">
                                                    <input type="text" id="address" name="address" required value="{{old('address')}}"
                                                           class="form-control col-12"/>
                                                </div><!-- /.col-* -->
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-* -->
                                    </div>
                                </div>
                            </div><!-- /.row.clpc -->
                        </div>
                    </div><!-- /.row -->
                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    <script>
        CKEDITOR.replace('description');
        ajaxSelect('status_id', 'Status', 'slug=in-active,active')
        ajaxSelect('businessCategory_id', 'BusinessCategory')
        ajaxSelect('salesStatus_id', 'SalesStatus')
        
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuBA_blyNZMwU-PgkI-ze6eVD1pNCuu9I&libraries=places,drawing&callback=initialize"
            async defer></script>
    
    <script type='text/javascript'>
        var all_overlays = [];
        var selectedShape;
        function clearSelection() {
                if (selectedShape) {
                    selectedShape.setEditable(false);
                    selectedShape = null;
                }
            }

            function setSelection(shape) {
                clearSelection();
                selectedShape = shape;
                shape.setEditable(true);
                
            }

            function deleteSelectedShape() {
            if (selectedShape) {
                selectedShape.setMap(null);
                document.getElementById('address-points').value = ''
            }
            }


        function initialize() {

            $('form').on('keyup keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");

                const latitude = 24.68015824409239;
                const longitude =46.66315286552702;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                
                var polyOptions = {
                    strokeWeight: 0,
                    fillOpacity: 0.45,
                    editable: true
                };
                const drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControl: true,
                    drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON,],
                            polygonOptions: polyOptions,
                            map: map
                        },
                        
                    });
                   // google.maps.event.addListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
                    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
                        all_overlays.push(e);
                        if (e.type != google.maps.drawing.OverlayType.MARKER) {
                        // Switch back to non-drawing mode after drawing a shape.
                        drawingManager.setDrawingMode(null);

                        // Add an event listener that selects the newly-drawn shape when the user
                        // mouses down on it.
                        var newShape = e.overlay;
                        newShape.type = e.type;
                        google.maps.event.addListener(newShape, 'click', function() {
                            setSelection(newShape);
                        });
                        setSelection(newShape);
                        }

                    });

                    google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
                        // assuming you want the points in a div with id="info"
                        var arr = [];
                        for (var i = 0; i < polygon.getPath().getLength(); i++) {
                            arr.push(polygon.getPath().getAt(i).toUrlValue(6))
                        }

                       setPointsCoordinates(arr);
                    });
                drawingManager.setMap(map);
                const marker = new google.maps.Marker({
                    draggable: true,
                    map: map,
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                });
                google.maps.event.addListener(marker, 'dragend', function(marker) {
                    var latLng = marker.latLng;
                    document.getElementById('address-latitude').value = latLng.lat();
                    document.getElementById('address-longitude').value = latLng.lng();
                });
                marker.se

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
            google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape)
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }
        
        function setPointsCoordinates(pt) {
            const longitudeField = document.getElementById("address-points");
            longitudeField.value = pt;
        }
    </script>
    
<script>
    var toggler = document.getElementsByClassName("reference-tab");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".reference-nested").classList.toggle("nested-active");
            this.querySelector('.fa').classList.toggle("fa-plus");
            this.querySelector('.fa').classList.toggle("fa-minus");
        });
    }
</script>

@endpush
