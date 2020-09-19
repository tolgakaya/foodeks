
$(document).ready(function () {
    $('body').on('click', '.remove_item', function () {
        var silRow = $(this).attr('id');

        var ans = confirm("Kaydı silmek istiyor musunuz?");
        if (ans) {
            var mealModel = {
                rowid: silRow
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "/cart/delete",
                data: JSON.stringify(mealModel),
                type: "POST",
                contentType: "application/json;charset=UTF-8",
                dataType: "json",
                beforeSend: function () {
                    // Show image container
                    $("#loadergif").show();
                },
                success: function (result) {
                    console.log(result);
                    $('.cartbody').empty();
                    // $('#cd_cartbody').empty();
                    $('.total').empty();
                    var html = '';
                    var htmlTotal = '';
                    var htmlQuantity = '';
                    $.each(result.cart, function (key, item) {
                        var rowPrice = 0;
                        if (item.attributes.option) {
                            rowPrice = parseInt(item.quantity, 10) * (parseFloat(item.price) + parseFloat(item.attributes.option.fee));

                        } else {
                            rowPrice = parseInt(item.quantity, 10) * parseFloat(item.price);

                        }

                        html += '<tr class="info">';
                        html += '<td>';
                        html += '<a href="#0" class="remove_item" id="' + item.id + '"><i class="icon_minus_alt"></i></a>';
                        html += '<strong>' + item.quantity + 'X</strong>;'
                        if (item.attributes.option) {
                            html += '<strong>' + item.attributes.option.option + '</strong>';
                        }

                        html += item.name;
                        html += '</td>';
                        // $row->quantity * ($row->price + $row->attributes['option']->fee

                        html += '<td> <strong class="pull-right">' + rowPrice + 'TL</strong> </td> </tr>';
                        if (item.attributes.extras) {
                            $.each(item.attributes.extras, function (k, ex) {
                                html += '<tr>';
                                html += ' <td class="pull-right"><strong>Ekstra </strong>';

                                // html+=' <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a>';
                                html += ex.extra;
                                html += '</td>';
                                html += '<td>';
                                html += '<strong class="pull-right">' + ex.fee + '</strong>';
                                html += '</td>';
                                html += '</tr>';
                            });
                        }


                    });

                    htmlTotal += ' <span class="pull-right">' + result.total + 'TL</span>';

                    htmlQuantity += result.quantity;
                    if (result.quantity > 0) {
                        $('.cd-cart').removeClass('gizle');
                        $('.cd-cart').addClass('goster');
                    } else {
                        $('.cd-cart').removeClass('goster');
                        $('.cd-cart').addClass('gizle');
                    }
                    $('#quantity').empty();
                    $('#quantity').append(htmlQuantity);
                    $('.total').append(htmlTotal);
                    $('.cartbody').append(html);
                },
                complete: function (data) {
                    // Hide image container
                    $("#loadergif").hide();
                },

                error: function (errormessage) {
                    alert(errormessage.responseText);
                }
            });

        }
    });

    $(".add_to_basket").click(function (e) {
        e.preventDefault();
        var mealid = $(this).attr('id');
        var menuid = $('#menuid').val();
        var fiyat = $("#fiyat" + mealid).val();
        var idd = "option" + mealid;
        var optionid = $("input[name = " + idd + "]:checked").val();

        var exid = "extra" + mealid;
        var extras = [];
        $.each($("input[name = " + exid + "]:checked"), function () {
            extras.push($(this).val());
            console.log($(this).val());
        });
        var mealModel = {
            mealid: mealid,
            fiyat: fiyat,
            miktar: 1,
            optionid: optionid,
            menuid: menuid,
            extras: extras
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/cart/add",
            data: JSON.stringify(mealModel),
            type: "POST",
            contentType: "application/json;charset=UTF-8",
            dataType: "json",
            beforeSend: function () {
                // Show image container
                $("#loadergif").show();
            },
            success: function (result) {
                // console.log(result);
                if (result.code == 'mix') {
                    // ask for clear cart
                    // var conf=confirm(result.message);
                    if (confirm(result.message)) {
                        console.log('okeeeeeeeeeeey');
                        return;
                    }
                }
                $('.cartbody').empty();
                $('.total').empty();

                //   addToCart();
                var html = '';
                var htmlTotal = '';
                var htmlQuantity = '';
                $.each(result.cart, function (key, item) {
                    var rowPrice = 0;
                    if (item.attributes.option) {
                        rowPrice = parseInt(item.quantity, 10) * (parseFloat(item.price) + parseFloat(item.attributes.option.fee));

                    } else {
                        rowPrice = parseInt(item.quantity, 10) * parseFloat(item.price);

                    }

                    html += '<tr class="info">';
                    html += '<td>';
                    html += '<a href="#0" class="remove_item" id="' + item.id + '"><i class="icon_minus_alt"></i></a>';
                    html += '<strong>' + item.quantity + 'X</strong>;'
                    if (item.attributes.option) {
                        html += '<strong>' + item.attributes.option.option + '</strong>';
                    }

                    html += item.name;
                    html += '</td>';
                    // $row->quantity * ($row->price + $row->attributes['option']->fee

                    html += '<td> <strong class="pull-right">' + rowPrice + 'TL</strong> </td></tr>';
                    if (item.attributes.extras) {
                        $.each(item.attributes.extras, function (k, ex) {
                            html += '<tr>';
                            html += '  <td class="pull-right"><strong>Ekstra </strong>';

                            // html+=' <a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a>';
                            html += ex.extra;
                            html += '</td>';
                            html += '<td>';
                            html += '<strong class="pull-right">' + ex.fee + '</strong>';
                            html += '</td>';
                            html += '</tr>';
                        });
                    }


                });

                htmlTotal += '<span class="pull-right">' + result.total + 'TL</span>';
                $('.total').append(htmlTotal);
                htmlQuantity += result.quantity;
                if (result.quantity > 0) {
                    $('.cd-cart').removeClass('gizle');
                    $('.cd-cart').addClass('goster');
                } else {
                    $('.cd-cart').removeClass('goster');
                    $('.cd-cart').addClass('gizle');
                }
                $('#quantity').empty();
                $('#quantity').append(htmlQuantity);
                $('.cartbody').append(html);

            },
            complete: function (data) {
                // Hide image container
                $("#loadergif").hide();
            },
            error: function (errormessage) {
                alert(errormessage.responseText);
            }
        });
    });
});
