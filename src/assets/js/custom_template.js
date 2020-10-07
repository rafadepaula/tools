$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.delete-media', function(){
        let url = $(this).data('route');
        let imgContainer = $(this).parent();
        if(typeof $(this).data('type') != 'undefined' && $(this).data('type') == 'file')
            imgContainer = imgContainer.parent();
        Swal.fire({
            title: 'Você tem certeza?',
            text: 'Confirme a deleção desta mídia.',
            icon: 'warning',
            confirmButtonText: 'Sim, deletar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }).then(function(result){
           if(result.isConfirmed){
               Swal.fire('Deletando...');
               $.ajax({
                   type: 'delete',
                   url: url
               }).done(function(e){
                   console.log(e);
                   imgContainer.remove();
                   Swal.fire('Mídia deletada com sucesso.');
               });
           }
        });
    });
})