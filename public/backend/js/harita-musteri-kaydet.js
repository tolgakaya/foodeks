
//query stringle müşteri ID gelecek ve  burada müşteri ID'ye göre latlong müşteri kaydı yapılacak.
var map;
var markers = [];
var bounds = new google.maps.LatLngBounds();
var panorama;

var url = '/api/restaurant/' + id.value;


function initialize() {

    var lat = 36.066256248568465;
    var lng = 32.83886153222488;
    var mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        // zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("myMap"),
        mapOptions);

    google.maps.event.addListener(map, 'click', function (event) {
        addMarker(event.latLng);
    });

    $.getJSON(url,
        function (data) {

            var coordinate = data.coordinate;
            var lat = data.latitude;
            var lng = data.longitude;

            // var temiz1 = coordinate.replace('(', ' ');
            // var temiz2 = temiz1.replace(')', ' ');
            // var tertemiz = temiz2.trim();

            // var liste = tertemiz.split(',');
            // lat = liste[0].trim();
            // lng = liste[1].trim();
            console.log(lat);
            console.log(lng);
            var pos = new google.maps.LatLng(lat, lng);
            addMarker(pos);

        })
        .fail(
            function (jqXHR, textStatus, err) {
                console.log('api hatasi');
            });

    map.setZoom(2);


}

function goster(lat, lng, address) {

    google.maps.event.addListener(map, 'click', function (event) {
        addMarker(event.latLng);
    });

    var pos = new google.maps.LatLng(lat, lng);
    addMarker(pos);


    var infotext = address + '<hr>' +
        'Latitude: ' + lat + '<br>Longitude: ' + lng;
    var infowindow = new google.maps.InfoWindow();
    infowindow.setContent(infotext);
    infowindow.setPosition(new google.maps.LatLng(lat, lng));
    infowindow.open(map);

    //var pos = new google.maps.LatLng(baslangic.lat, baslangic.lng);
    //addMarker(pos);



}


function addMarker(location) {
    deleteMarkers();
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });

    txtLatitude.value = location;
    ltd.value = location.lat();
    lng.value = location.lng();
    bounds.extend(location);
    map.fitBounds(bounds);
    markers.push(marker);

}
function clearMarkers() {
    setAllMap(null);
}


function showMarkers() {
    setAllMap(map);
}


function deleteMarkers() {
    clearMarkers();
    markers = [];
}
function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function getLatLng() {
    var address = document.getElementById("txtAddress").value;
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var longaddress = results[0].address_components[0].long_name;
            var latitude = results[0].geometry.location.lat();
            //var longitude = results[0].geometry.location.lng();
            txtLatitude.value = latitude;
            //txtLongitude.value = longitude;
            goster(results[0].geometry.location.lat(), results[0].geometry.location.lng(), longaddress);
        } else {
            alert('Geocode error: ' + status);
        }
    });
}
