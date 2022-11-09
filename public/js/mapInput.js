var Map = {
    mapContainer: document.getElementById('address-map'),
    inputAutocomplete: document.getElementById('address-input'),
    inputLat: $("input[name=address_latitude]"),
    inputLng: $("input[name=address_longitude]"),
    map: {},
    geocoder: new google.maps.Geocoder(),
    autocomplete: {},
    init: function init() {
        var _this = this;

        this.autocomplete = new google.maps.places.Autocomplete(this.inputAutocomplete);
        var latLng = new google.maps.LatLng(parseFloat(this.inputLat.val()), parseFloat(this.inputLng.val()));

        if (this.inputLat.val() && this.inputLng.val()) {
            latLng = new google.maps.LatLng(this.inputLat.val(), this.inputLng.val());
        }

        this.map = new google.maps.Map(this.mapContainer, {
            zoom: 15,
            center: latLng,
        });

        var marker = new google.maps.Marker({
            position: latLng,
            map: _this.map,
            draggable: true
        });

        this.map.markers = [marker];

        this.map.setCenter(latLng);

        marker.addListener('dragend', function () {
            _this.inputLat.val(marker.getPosition().lat());

            _this.inputLng.val(marker.getPosition().lng());

            _this.geocodePosition(marker.getPosition());

            _this.map.setCenter(marker.getPosition());
        });

        this.autocomplete.addListener('place_changed', function () {
            _this.map.markers.forEach(function (marker) {
                marker.setMap(null);
            });

            var place = _this.autocomplete.getPlace();

            _this.inputLat.val(place.geometry.location.lat());

            _this.inputLng.val(place.geometry.location.lng());

            var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()); // create marker

            var marker = new google.maps.Marker({
                position: latlng,
                map: _this.map,
                draggable: true
            });

            _this.map.markers = [marker];

            _this.map.setCenter(latlng);

            marker.addListener('dragend', function () {

                _this.inputLat.val(marker.getPosition().lat());

                _this.inputLng.val(marker.getPosition().lng());

                _this.geocodePosition(marker.getPosition());

                _this.map.setCenter(marker.getPosition());
            });
        });
    },
    geocodePosition: function geocodePosition(pos) {
        var _this = this;

        this.geocoder.geocode({
            latLng: pos
        }, function (responses) {
            if (responses && responses.length > 0) {
                _this.updateMarkerAddress(responses[0].formatted_address);
            } else {
                _this.updateMarkerAddress('Nenhuma coordenada encontrada');
            }
        });
    },
    updateMarkerAddress: function updateMarkerAddress(str) {
        this.inputAutocomplete.value = str;
    },
    renderMap: function renderMap($el) {
        var _this = this;

        var $markers = $el.find('.marker');
        var args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            mapTypeControl: false
        };
        var map = new google.maps.Map($el[0], args);
        map.markers = [];
        $markers.each(function () {
            _this.add_marker($(this), map);
        });

        _this.center_map(map);
    },
    add_marker: function add_marker($marker, map) {
        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        map.markers.push(marker);
    },

    delete_markers: function delete_markers(map) {
        for (var i = 0; i < map.markers.length; i++) {
            map.markers[i].setMap(null);
        }

        map.markers = [];
    },

    center_map: function center_map(map) {
        var bounds = new google.maps.LatLngBounds();
        $.each(map.markers, function (i, marker) {
            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(latlng);
        });

        if (map.markers.length == 1) {
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
        } else {
            map.fitBounds(bounds);
        }
    }
};
$(document).ready(function () {
    Map.init();
});
