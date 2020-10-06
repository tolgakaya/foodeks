$(document).ready(function () {
    fetch();
    setInterval(function () {
        fetch();
    }, 500000);
    function fetch() {
        $.ajax({
            url: '/admin/alert/paket',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                // console.log(response.orders);
                var _html = '';
                var adisyonHtml = '';
                var paket = 0;
                var paketCountHtml = '';
                var currentPaket = $('#currentPaket').val();
                $.each(response.orders, function (index, value) {
                    paket = paket + 1;
                    // console.log(value);
                    // _html += '<div class="col-lg-3 satir">';
                    _html += '<a class="dropdown-item d-flex" href="/admin/orders/">';
                    // _html += ' <div>';
                    _html += '<strong>' + 'Paket ' + value.id + '</strong>' + ' ' + value.address.contact_name + ' ' + value.address.phone;
                    _html += '</a >';
                });

                if (paket > 0) {
                    // console.log('1. paket sıfırdan büyük');
                    $('#paketcount').empty();
                    paketCountHtml += ' <span  class="badge badge-danger">' + paket + '</span>';
                    $("#paketcount").append(paketCountHtml);
                    if (currentPaket == null || currentPaket < paket) {
                        var audio = new Audio("http://foodeks/backend/sounds/alert.wav");

                        audio.play();
                    }
                    $('#currentPaket').val(paket);

                }

                $("#alarmpaket").empty();
                $("#alarmpaket").append(_html);

                var adisyon = 0;
                var adisyonCountHtml = '';
                $.each(response.adisyons, function (index, value) {
                    $.each(value.orderdetails, function (i, v) {
                        adisyon = adisyon + 1;
                    });
                    console.log(value);
                    // adisyonHtml += '<h3>' + value.id + '</h3>';
                    // adisyonHtml += '<div class="col-lg-3 satir">';
                    adisyonHtml += '<a class="dropdown-item d-flex" href="/admin/orders/masa/adisyons/">';
                    // adisyonHtml += ' <div>';
                    adisyonHtml += '<strong>' + 'Masa ' + value.masaid + '</strong> Yeni sipariş geldi';
                    adisyonHtml += '</a >';
                });

                var currentAdisyon = $('#currentAdisyon').val();

                if (adisyon > 0) {
                    $('#adisyoncount').empty();
                    adisyonCountHtml += ' <span  class="badge badge-danger">' + adisyon + '</span>';
                    $("#adisyoncount").append(adisyonCountHtml);

                    if (currentAdisyon == null || currentAdisyon < adisyon) {
                        var audio = new Audio("http://foodeks/backend/sounds/alert.wav");

                        audio.play();
                    }
                    $('#currentAdisyon').val(adisyon);

                }


                $("#alarmadisyon").empty();
                $("#alarmadisyon").append(adisyonHtml);

                var booking = 0;
                var bookingCountHtml = '';
                var bookingHtml = '';
                $.each(response.bookings, function (index, value) {
                    booking = booking + 1;
                    // console.log(value);
                    // adisyonHtml += '<h3>' + value.id + '</h3>';
                    // bookingHtml += '<div class="col-lg-3 satir">';
                    bookingHtml += '<a class="dropdown-item d-flex" href="/admin/bookings/">';
                    // bookingHtml += ' <div>';
                    bookingHtml += '<strong>' + 'Rezervasyon ' + value.name + '</strong>' + ' ' + value.phone + ' ' + value.quantity + ' kişi';
                    bookingHtml += '</a >';
                });

                if (booking > 0) {
                    $('#bookingcount').empty();
                    bookingCountHtml += ' <span  class="badge badge-danger">' + booking + '</span>';
                    $("#bookingcount").append(bookingCountHtml);
                }


                $("#alarmbooking").empty();
                $("#alarmbooking").append(bookingHtml);

            }
        });
    }
});

