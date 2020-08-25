$(document).ready(function () {
    var table = $('#example3').DataTable();
    $('#example3 #userbody').on('click', 'tr', function () {

        //#region satır seçme olayı
        if ($(this).hasClass('selected')) {

            $(this).removeClass('selected');
            console.log('seçimi kaldırdım.');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');

            var dataArr = [];
            var rows = $('tr.selected');
            var rowData = table.rows(rows).data();
            $.each($(rowData), function (key, value) {
                dataArr.push(value); //"name" being the value of your first column.
            });
            var userid = dataArr[0][0];
            console.log(userid);
            adresSecim(userid);

            $('#btnAdresEkle').click(function () {
                var secilen = "adsecim";
                var ad_id = $("input[name =" + secilen + "]:checked").val();
                console.log('ad_id=' + ad_id);
                var city = $('#' + ad_id).data('city');
                console.log('userid ' + userid + ' city ' + city);
                // sepetEkle(mealid, menuid, fiyat, optionid, extras.get());
            });

        }

    });

    function adresSecim(secilen) {
        console.log('secimi yaptım' + secilen);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/admin/orders/addresses/" + secilen,
            // data: JSON.stringify(mealModel),
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            success: function (result) {
                console.log(result);
                html = '';
                htmlExt = '';
                $.each(result.addresses, function (key, item) {
                    console.log(item);
                    html += '<div class="custom-control custom-radio custom-control-inline">';
                    html += '<input type="radio" class="custom-control-input optionBox" id="ad' + item.id + '" name="adsecim" value="';
                    html += item.id + '" data-city="' + item.city + '">';
                    html += '<label class="custom-control-label" for="ad' + item.id + '">';
                    html += item.address;
                    html += '</label> ';

                    html += '</div>';
                });

                $('.adressecim').empty();
                $('.adressecim').html(html);

            },
            error: function (errormessage) {
                alert(errormessage.error);
            }
        });
    }
    //documentReady



});
