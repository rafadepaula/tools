$(function(){
    $('.select2-init').each(function(){
        let opts = {};
        if($(this).hasClass('enable-new'))
            opts.tags = true;
        $(this).select2(opts);
    });
})