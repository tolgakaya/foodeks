$(document).ready(function () {
    $('#btnForm').click(function () {
        // var formData = $('#modalForm').serialize();

        //seçilen resimlerin idlerini diziye atıyor
        var extras = $('.selecteds:input:checked').map(function () {
            return $(this).val();
        });
        console.log('Posting the following: ', extras.get());
        var secilenler = { selecteds: extras.get() };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: '/admin/pages/about/media/delete/mass',
            data: secilenler,
            type: 'post',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $("#modal-default").modal('hide');
            }
        });
    });
});

$(document).ready(function () {
    $("#modal-default").on('shown.bs.modal', function () {
        // var _totalCurrentResult = $(".satir").length;
        //her zaman açılışta skip 0 olarak mediayı çekecez.  bu yüzden totalCurrentResult alanını kullanmıyoruz burada
        // Ajax Reuqest
        $.ajax({
            url: '/admin/pages/about/more',
            type: 'get',
            dataType: 'json',
            data: {
                skip: 0
            },
            beforeSend: function () {
                $(".load-more").html('Loading...');
            },
            success: function (response) {
                // console.log(response);
                var _html = '';
                var image = "/images/";
                $.each(response, function (index, value) {
                    _html += '<div class="col-lg-3 satir">';
                    _html += '<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                    _html += '<input type="checkbox" class="custom-control-input selecteds" name="selecteds" id="' + value.filename + '" value="' + value.id + '">';
                    _html += '<label class="custom-control-label" for="' + value.filename + '">';
                    _html += '<img src="' + image + value.filename + '" class="big" alt="" title="Beautiful Image" />';
                    _html += '</label>';
                    _html += '</div>';
                    _html += '</div>';
                });
                $(".gallery").empty();
                $(".gallery").append(_html);
                // Change Load More When No Further result
                var _totalCurrentResult = $(".satir").length;
                var _totalResult = parseInt($(".load-more").attr('data-totalResult'));
                console.log(_totalCurrentResult);
                console.log(_totalResult);
                if (_totalCurrentResult == _totalResult) {
                    $(".load-more").remove();
                } else {
                    $(".load-more").html('Load More');
                }
            }
        });
    });

});

$(document).ready(function () {
    $("#btn-search").on('click', function (e) {
        e.preventDefault();
        // var _totalCurrentResult = $(".satir").length;
        // Ajax Reuqest
        var param = $("#term").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: '/admin/pages/about/media/search',
            type: 'post',
            dataType: 'json',
            data: {
                term: param
            },
            // beforeSend:function(){
            //     $(".load-more").html('Loading...');
            // },
            success: function (response) {
                var _html = '';
                var image = "/images/";

                $.each(response, function (index, value) {

                    _html += '<div class="col-lg-3 satir">';
                    _html += '<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                    _html += '<input type="checkbox" class="custom-control-input selecteds" name="selecteds" id="' + value.filename + '" value="' + value.id + '">';
                    _html += '<label class="custom-control-label" for="' + value.filename + '">';
                    _html += '<img src="' + image + value.filename + '" class="big" alt="" title="Beautiful Image"  />';
                    _html += '</label>';
                    _html += '</div>';
                    _html += '</div>';

                });
                $(".gallery").empty();
                $(".gallery").append(_html);
                // Change Load More When No Further result
                var _totalCurrentResult = $(".satir").length;
                var _totalResult = parseInt($(".load-more").attr('data-totalResult'));
                console.log(_totalCurrentResult);
                console.log(_totalResult);
                if (_totalCurrentResult == _totalResult) {
                    $(".load-more").remove();
                } else {
                    $(".load-more").html('Load More');
                }
            }
        });
    });
});

$(document).ready(function () {
    $(".load-more").on('click', function () {
        var _totalCurrentResult = $(".satir").length;
        // Ajax Reuqest
        $.ajax({
            url: '/admin/pages/about/more',
            type: 'get',
            dataType: 'json',
            data: {
                skip: _totalCurrentResult
            },
            beforeSend: function () {
                $(".load-more").html('Loading...');
            },
            success: function (response) {
                var _html = '';
                var image = "/images/";

                $.each(response, function (index, value) {

                    _html += '<div class="col-lg-3 satir">';
                    _html += '<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
                    _html += '<input type="checkbox" class="custom-control-input selecteds" name="selecteds" id="' + value.filename + '" value="' + value.id + '">';
                    _html += '<label class="custom-control-label" for="' + value.filename + '">';
                    _html += '<img src="' + image + value.filename + '" class="big" alt="" title="Beautiful Image"  />';
                    _html += '</label>';
                    _html += '</div>';
                    _html += '</div>';

                });
                $(".gallery").append(_html);

                var _totalCurrentResult = $(".satir").length;
                var _totalResult = parseInt($(".load-more").attr('data-totalResult'));
                console.log('current result' + _totalCurrentResult);
                // console.log('satir sayisi' +sayi);
                console.log('total result' + _totalResult);
                if (_totalCurrentResult == _totalResult) {
                    $(".load-more").remove();
                } else {
                    $(".load-more").html('Load More');
                }
            }
        });
    });
});


Dropzone.options.dropzone =
{
    maxFilesize: 12,
    renameFile: function (file) {
        var dt = new Date();
        var time = dt.getTime();
        return time + file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: true,
    timeout: 5000,
    removedfile: function (file) {
        var name = file.upload.filename;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: 'POST',
            url: '{{ url("admin/pages/about/media/delete") }}',
            data: { filename: name },
            success: function (data) {
                alert("File has been successfully removed!!");
            },
            error: function (e) {
                console.log(e.message);
            }
        });
        var fileRef;
        return (fileRef = file.previewElement) != null ?
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },

    success: function (file, response) {
        var _html = '';
        var image = "/images/";

        $.each(response, function (index, value) {


            _html += '<div class="col-lg-3 satir">';
            _html += '<div class="card shadow overflow-hidden custom-control custom-checkbox image-checkbox">';
            _html += '<input type="checkbox" class="custom-control-input selecteds" value= "' + index + '" id="' + index + '" >';
            _html += '<label class="custom-control-label" for="' + index + '">';
            _html += '<img src="' + image + value + '" class="big" alt="" title="Beautiful Image"  />';
            _html += '</label>';
            _html += '</div>';
            _html += '</div>';

        });
        $(".gallery").prepend(_html);

    },
    error: function (file, response) {
        return false;
    }
};