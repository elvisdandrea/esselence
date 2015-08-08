var page = 2;
var paginationActive = true;

$(window).scroll(function() {
    if(paginationActive) {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            $.ajax({
                url: '/esselence/public/imoveis/listagem?' + location.search.substr(1) + '&page=' + page,
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