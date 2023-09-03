@extends('cms.layouts.app')
@section('content')
    <div class="row admin-form-container">
        <div class="col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>
                        Setting Information
                    </h3>

                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <button class="admin-form-save-btn" type="submit" form="setting-details-form">save
                            </button>
                            <button class="admin-form-close-btn-red" onclick="resetPage()">reset</button>


                        </li>
                    </ul><!-- /.nav -->
                    <div class="clearfix"></div>
                </div><!-- /.x_title -->

                <form id="setting-details-form" method="POST" action="{{ route('setting.update', $setting->_id) }}"
                    class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row pt-5">
                        <div class="col-12 ">
                            <div class="clp">
                                <h5>
                                    CONTACT INFO
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="row">

                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="name">Contact Phone<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <input type="text" id="contact_phone" name="contact_phone" required
                                                    value="{{ $setting->contact_phone }}" class="form-control col-12" />
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="name">Contact Email<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <input type="text" id="contact_email" name="contact_email" required
                                                    value="{{ $setting->contact_email }}" class="form-control col-12" />
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="name">Contact Website<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <input type="text" id="contact_website" name="contact_website" required
                                                    value="{{ $setting->contact_website }}" class="form-control col-12" />
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="opening_hours">Opening hours</label>
                                            <div class="col-12">
                                                <textarea class="col-md-12 form post-text" name="opening_hours" maxlength="150">{!! $setting->opening_hours !!}</textarea>
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                </div>





                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                    <div class="row pt-5">
                        <div class="col-12 ">
                            <div class="clp">
                                <h5>
                                    Socail Links
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="row">
                                    
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="name">Facebook<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <input type="text" id="facebook" name="facebook" required
                                                    value="{{ $setting->facebook }}" class="form-control col-12" />
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="name">Instagram<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <input type="text" id="instagram" name="instagram" required
                                                    value="{{ $setting->instagram }}" class="form-control col-12" />
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="name">Twitter<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <input type="text" id="twitter" name="twitter" required
                                                    value="{{ $setting->twitter }}" class="form-control col-12" />
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->
                                    <div class="col-lg-4 pr-md-4 pl-md-4 p-0 mt-md-4 mt-2" style="min-height: 60px">
                                        <div class="form-group">
                                            <label class="control-label col-12" for="name">LinkedIn<span
                                                    class="required" style="color:red">*</span></label>
                                            <div class="col-12">
                                                <input type="text" id="linkedin" name="linkedin" required
                                                    value="{{ $setting->linkedin }}" class="form-control col-12" />
                                            </div><!-- /.col-* -->
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-* -->

                                </div>
                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                    <div class="row pt-5">
                        <div class="col-12 ">
                            <div class="clp">
                                <h5>
                                    LOCATION
                                    <span class="float-right">
                                        <button class="clp-toggler" type="button">Hide</button>
                                    </span>
                                </h5>
                                <hr class="rounded form-horizontal-line">
                            </div><!-- /.clp -->
                            <div class="row clpc active" style="display: block;">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="col-md-12 mt-2" style="min-height: 60px;padding: 10px">
                                         
                                            <div class="form-group" style="padding-top: 10px">
                                                <input type="text" id="address-input"  placeholder="Search..."
                                                    class="form-control map-input" value="">
                                                <input type="hidden" name="address_latitude" id="address-latitude"
                                                    value="{{ $setting->location[0] ?? '' }}" />
                                                <input type="hidden" name="address_longitude" id="address-longitude"
                                                    value="{{ $setting->location[1] ?? '' }}" />
                                                <div id="address-map-container" style="width:100%;height:400px;position: relative; ">
                                                    
                                                    
                                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                                </div>
                                                <div id="info"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-12" for="address">Address<span
                                                    class="required" style="color:red">*</span></label>
                                                <div class="col-12">
                                                    <textarea class="col-md-12 form post-text" name="address" maxlength="150">{!! $setting->address !!}</textarea>

                                                </div><!-- /.col-* -->
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-* -->
                                    </div>

                                </div>





                            </div><!-- /.row.clpc -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                </form>
            </div><!-- /.x_panel -->
        </div><!-- /.col-* -->
    </div><!-- /.row -->
@endsection
@push('js')
    <script>
        CKEDITOR.replace('opening_hours');
        CKEDITOR.replace('address');

        $(function() {
            $('.select2-multiple').select2({
                width: '100%',
                multiple: true,
            });
        });

        function readURL(input, preview) {

            var id = input.id;
            document.getElementById('hidden_' + id).value = 1
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.show()
                    preview.attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuBA_blyNZMwU-PgkI-ze6eVD1pNCuu9I&libraries=places,drawing&callback=initialize"
        async defer></script>

    <script type='text/javascript'>

        var all_overlays = [];



        function initialize() {
            $('form').on('keyup keypress', function(e) {
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
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(
                    fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || 24.68015824409239;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 46.66315286552702;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {
                        lat: latitude,
                        lng: longitude
                    },
                    zoom: 13
                });


                var propertyCoords = '';

                var drawingManager = null;
                var points_test = [];


                drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: null,
                    drawingControl: false,
                    drawingControlOptions: {
                        position: google.maps.ControlPosition.TOP_CENTER,
                        // drawingModes: [google.maps.drawing.OverlayType.POLYGON, ],

                        map: map
                    },

                });
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
                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({
                    input: input,
                    map: map,
                    marker: marker,
                    autocomplete: autocomplete
                });
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({
                        'placeId': place.place_id
                    }, function(results, status) {
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
@endpush
