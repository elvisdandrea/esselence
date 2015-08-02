$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
        $.ajax({
            url : '/esselence/public/imoveis/show-more',
            success : function(html){
                $('#lista-imoveis').append(html);
            }
        });
    }
});