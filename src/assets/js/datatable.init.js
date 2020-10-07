$(function(){
    $('.datatable-init').each(function(){
        const tableDefs = createTableDefs($(this));
        $(this).DataTable(tableDefs);
    });
});

function createTableDefs(container){
    let tableDefs = {
        language: {
            "sEmptyTable":   "Não foi encontrado nenhum registo",
            "sLoadingRecords": "A carregar...",
            "sProcessing":   "A processar...",
            "sLengthMenu":   "Mostrar _MENU_ registos",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registos",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registos",
            "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
            "sInfoPostFix":  "",
            "sSearch":       "Procurar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
            },
            "oAria": {
                "sSortAscending":  ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
    }
    tableDefs = dateColumnDef(container, tableDefs);
    return tableDefs;
}

function dateColumnDef(container, tableDefs){
    let findResult = container.find('.date-column');
    if(findResult.length > 0){
        $.fn.dataTable.moment( 'DD/MM/YYYY HH:mm:ss' );
        const cellIndex = $(findResult[0])[0].cellIndex;
        tableDefs.order = [[ cellIndex, "desc" ]];
    }
    return tableDefs;
}