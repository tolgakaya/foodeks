

var hepsi = {};
var map = null;
var bounds = null;
var panorama;
var musteriler = null;


function GetAllMusteris() {

    $.ajax({
        type: "GET",
        url: "/api/restaurants/",
        contentType: "json",
        dataType: "json",
        success: function (data) {

            $.each(data, function (key, value) {
                //stringify
                var jsonData = JSON.stringify(value);
                //Parse JSON
                var objData = $.parseJSON(jsonData);
                var id = objData.id;
                var name = objData.name;
                var latitude = objData.latitude;
                var longitude = objData.longitude;

                hepsi[id] = { center: new google.maps.LatLng(latitude, longitude), name: name, id: id };


            });
        },
        error: function (xhr) {
            console.log(xhr);
        }
    });

    return hepsi;
}


var infowindow = new google.maps.InfoWindow(
    {
        size: new google.maps.Size(150, 50)
    });




function createMarkerM(latlng, html) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        // icon: '/img/musteri.png',
        animation: google.maps.Animation.DROP,
        zIndex: Math.round(latlng.lat() * -100000) << 5
    });
    bounds.extend(latlng);
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(contentString);
        infowindow.open(map, marker);

        // panorama = new google.maps.StreetViewPanorama(
        //     document.getElementById('pano'), {
        //     position: latlng,
        //     pov: {
        //         heading: 34,
        //         pitch: 10
        //     }
        // });
        // map.setStreetView(panorama);
    });
}



musteriler = GetAllMusteris();

function initializeMusteriler() {
    var myOptions = {
        zoom: 10,
        center: new google.maps.LatLng(-33.9, 151.2),
        mapTypeControl: true,
        mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },
        navigationControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"),
        myOptions);

    bounds = new google.maps.LatLngBounds();

    google.maps.event.addListener(map, 'click', function () {
        infowindow.close();
    });


    for (var musteri in musteriler) {
        // console.log(musteriler[musteri].id);
        html = '';
        html += "<div class='panel panel-primary'>";
        html += "<div class='panel-heading'>";
        html += musteriler[musteri].name;
        html += "</div>";
        html += "<div class='panel-body'>";
        html += "<div class='table-responsive'>";
        html += "<div class='btn btn-xs-group'>";
        html += "<a href='javascript:map.setCenter(new google.maps.LatLng(" + musteriler[musteri].center.toUrlValue(6) + "));map.setZoom(20);'><i class='btn btn-xs btn-success '>Yaklaş</i></a> <a href='javascript:map.fitBounds(bounds);'><i class='btn btn-xs btn-danger'>Uzaklaş</i></a>";
        html += '<a href="restaurants/menu/' + musteriler[musteri].id + '" ><i class="btn btn - xs btn - primary btn - block">Menüye Bakın</i> </a>';
        html += "</div ></div ></div ></div ></div >";

        createMarkerM(musteriler[musteri].center, html);
    };

    map.fitBounds(bounds);

}


