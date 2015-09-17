var page = 2;
var paginationActive = true;

$(window).scroll(function() {
    if(paginationActive) {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            var url = '/imoveis/listagem?' + location.search.substr(1) + '&page=' + page;
            if($('#ordem').val() != '')
                url += '&order=' + $('#ordem').val();

            $.ajax({
                url: url,
                success: function (html) {
                    if(html == ''){
                        paginationActive = false;
                    }else {
                        page++;
                        $('#lista-imoveis').append(html);
                    }
                }
            });
        }
    }
});

$('#ordem').change(function() {
    if ($(this).val() != '') {
        $.ajax({
            url: '/imoveis/listagem?' + location.search.substr(1) + '&order=' + $(this).val(),
            success: function (html) {
                paginationActive = true;
                page = 2;
                $('#lista-imoveis').html(html);
            }
        });
    }
});