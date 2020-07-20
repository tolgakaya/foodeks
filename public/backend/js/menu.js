$(document).ready(function () {

    $(function () {
        $('.deletebutton').click(function () { alert('You clicked button with ID:' + this.id); });
    });
    function Delete(menid, mealid) {
        var ans = confirm("Kaydı silmek istiyor musunuz?");
        if (ans) {
            var silinecek = {
                'meal': mealid
            };
            $.ajax({
                url: "/admin/menus/details/delete/" + ID,
                data: silinecek,
                type: "POST",
                contentType: "application/json;charset=UTF-8",
                dataType: "json",
                success: function (result) {
                    console.log(result);
                },
                error: function (errormessage) {
                    alert(errormessage.responseText);
                }
            });
        }
    }
    //mealModal baslangıc
    $('#mealModal').on('show.bs.modal', function (event) {

        var categoryid = $(event.relatedTarget).data('val');
        console.log('categoridmizzzzzz' + categoryid);
        $.ajax({
            url: "/admin/meals/category/" + categoryid,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            success: function (result) {
                $('#mealcat').val(categoryid);
                $('#mealbody').empty();
                var html = '';
                $.each(result, function (key, item) {

                    html += '<tr>';
                    html += '<td>' + item.id + '</td>';
                    html += '<td>';
                    html += '<div class="avatar-group">';
                    html += '<a class="avatar avatar-md" data-toggle="tooltip" href="#">';
                    html += '<img src="' + item.image + '" class="rounded-circle" alt="" title="Beautiful Image" />';
                    html += '</a></div></td>';
                    html += '<td class="text-sm font-weight-600">' + item.name + '</td>';
                    html += '<td>' + item.description + '</td>';


                    // html += '<td><a href="#" onclick="return getbyID(' + item.id + ')">Düzenle</a> | <a href="#"
                    //         onclick="Delele(' + item.id + ')">Sil</a></td>';
                    html += '</tr>';

                });

                $('#mealbody').append(html);
                var table = $('#example2').DataTable();

                $('#example2 #mealbody').off('click');
                $('#example2 #mealbody').on('click', 'tr', function () {
                    console.log('clickledim');
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    } else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                });

                //btnsave
                $('#btnsave').click(function () {
                    var dataArr = [];
                    var rows = $('tr.selected');
                    var rowData = table.rows(rows).data();
                    $.each($(rowData), function (key, value) {
                        dataArr.push(value[0]); //"name" being the value of your first column.
                    });
                    var id = dataArr[0];
                    var fiyat = $('#mealfee').val();
                    var menuid = $('#menuid').val();
                    if (id && fiyat) {
                        console.log(id + ' ve ' + fiyat);
                        categorimiz = $('#mealcat').val();
                        console.log('categorimiz' + categorimiz)
                        var menuModel = {
                            meal_id: id,
                            fee: fiyat,
                            category: categorimiz
                        };
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            url: "/admin/menus/details/" + menuid,
                            data: JSON.stringify(menuModel),
                            type: "POST",
                            contentType: "application/json;charset=utf-8",
                            dataType: "json",
                            success: function (result) {
                                // console.log(result);
                                var catelement = $('#meal' + categorimiz);
                                var html = '';
                                var opHtml = "";
                                $.each(result.last, function (index, value) {
                                    console.log('idmiiizzzzzzzzzzzz' + result.myId);
                                    console.log(value);
                                    html += '<div id="accordion">';
                                    html += ' <div class="accordion">';
                                    html += ' <div class="accordion-header" data-toggle="collapse" data-val="' + value.id + '" data-target="#panel' + categorimiz + value.id + '">';
                                    html += ' <div class="row">';
                                    html += '<div class="col md-3 text-left "> ';
                                    html += '<div class="btn-group mb-0"> ';
                                    html += '<button type="button" class="btn btn-primary btn-sm dropdown-toggle"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">İşlemler</button> ';
                                    html += '<div class="dropdown-menu"> ';
                                    html += '<div class="dropdown-divider"></div> ';
                                    html += '<a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> Sil</a> </div> </div></div>';
                                    html += ' <div class="col md-9 text-right"><h4 >' + value.name + '</h4> </div> </div> </div>';
                                    html += ' <div class="accordion-body collapse show border border-top-0 text-sm" id="panel' + categorimiz + value.id + '" data-parent="#accordion">';
                                    html += ' <h2 class=" mb-0">Ürün Bilgileri</h2>';
                                    html += '<div class="grid-margin"> <div class=""> <div class="table-responsive"> ';
                                    html += '<table class="table card-table table-vcenter text-nowrap  align-items-center"> ';
                                    html += '<thead class="thead-light"><tr><th>Resim</th><th>Ürün İsmi</th><th>Açıklama</th><th>Fiyat</th> </tr></thead>';
                                    html += ' <tbody>  <tr>';

                                    html += ' <td>';
                                    html += ' <div class="avatar-group">';
                                    html += ' <a class="avatar avatar-md" data-toggle="tooltip" href="#"><img alt="Image placeholder" class="rounded-circle" src="assets/img/faces/female/8.jpg"></a>';
                                    html += ' </div> </td>';
                                    html += ' <td class="text-sm font-weight-600">' + value.name + '</td>';
                                    html += ' <td>' + value.description + ' </td>';
                                    html += ' <td class="text-nowrap">' + value.pivot.fee + '</td>';
                                    html += '</tr></tbody></table>';
                                    html += ' </div> </div> </div>';
                                    html += '<h2 class=" mb-0">Seçenekler</h2>';
                                    html += '<div class="grid-margin"> ';
                                    html += '<div class=""><div class="table-responsive">';
                                    html += '<table class="table card-table table-vcenter text-nowrap  align-items-center"> ';
                                    html += '<thead class="thead-light"> ';
                                    html += '<tr> ><th>Seçenek</th><th>Eklenecek Fiyat</th></tr></thead>';
                                    html += '<tbody id="option' + result.myId + '">';
                                    html += '</tbody></table> </div></div></div>';
                                    html += '<div id="extra' + result.myId + '"></div>';
                                    html += ' </div> </div>  </div>';

                                    $.each(value.options, function (index, val) {
                                        opHtml += '<tr>';
                                        opHtml += '<td class="text-sm font-weight-600"> ' + val.option + '</td>';
                                        opHtml += '<td class="text-nowrap"> ' + val.fee + '</td> </tr> '
                                    });
                                });
                                catelement.empty();
                                catelement.append(html);
                                var extraAlani = $('#option' + result.myId);
                                extraAlani.append(opHtml);
                                $('#mealModal').modal('hide');
                                //ürün ekleyeceğiz
                                urunalani = $('#meal' + categoryid);
                                // alert(urunalani.html);
                            },
                            error: function (errormessage) {
                                alert(errormessage.responseText);
                            }
                        });
                    } else {
                        console.log('lütfen bir ürün seçin ve fiyat girin');
                    }

                });

            },
            error: function (errormessage) {
                alert(errormessage.responseText);
            }
        });
    });

    // mealModal bitti
    $("#mealModal").on('hidden.bs.modal', function () {
        $(this).removeData('bs.modal');
        $('#example2').DataTable().clear().destroy();
    });


});