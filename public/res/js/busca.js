$('.btn-checkbox').click(function(){

    $(this).find('input[type="checkbox"]').prop('checked', function(_, checked) {
        return !checked;
    });

    var val = [];
    $('#dorm_search input[type="checkbox"]').each(function(){
        if ($(this).is(':checked')) {
            val.push($(this).attr('data-qnt'));
        }
        $('#dormitorios').val(val.join(','));
    });
});