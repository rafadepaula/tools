$(function(){
    $('.fileinput-init').each(function(){
        $(this).fileinput({
            'showUpload': false,
            'language': 'pt-BR',
            'showPreview': false,
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        });
    });

    $('body').on('click', '.kv-file-zoom', function(){
        $('body').find('.file-zoom-dialog').each(function(){
            $(this).removeClass('fade');
        })
    })
})