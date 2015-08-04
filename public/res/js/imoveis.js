$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
        $.ajax({
            url : '/esselence/public/imoveis/listagem',
            success : function(html){
                $('#lista-imoveis').append(html);
            }
        });
    }
});