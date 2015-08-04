$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
        var params = parseGetParams();
        $.ajax({
            url : '/esselence/public/imoveis/listagem?' + location.search.substr(1),
            success : function(html){
                $('#lista-imoveis').append(html);
            }
        });
    }
});