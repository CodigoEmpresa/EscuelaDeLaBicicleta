
/**
 * Created by daniel on 26/07/17.
 */
$(function() {
    $('.datatable').DataTable({ "language": {
        "url": 'public/Spanish.json'
    },responsive:true, dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'}

        ],});

    $('form[name=form_busqueda_reporte]').submit(function(e)
    {
        e.preventDefault();
        var formObj = $(this);
        var formURL = formObj.attr("action");
        var formData = new FormData(this);


        if ( $.fn.DataTable.isDataTable('.datatable') ) {
            $('.datatable').DataTable().destroy();
        }

        $('#tblRemittanceList tbody').empty();


            table = $('.datatable');
            table.DataTable({
                "language": {
                    "url": 'public/Spanish.json'
                },
                dom: 'Bfrtip',
                    buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                        {extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'LEGAL'}

                ],
                responsive:true,
                processing: true,
                serverSide: true,
                ajax:{
                    url: formURL,
                    type: 'POST',
                    data:  $(this).serializeArray()
                },
                columns: [
                    { data: 'id', name:'id'},
                    { data: 'Nombre', name:'Parque'},
                    { data: 'Fecha', name:'Fecha'},
                    { data: 'Clima', name:'Clima'},
                    { data: 'Nombre_Encargado', name:'Encargado'},
                    { data: 'Observaciones_Generales', name:'Observaciones'},
                    { data: 'Cedula', name:'Cedula'},
                    { data: 'Primer_Apellido', name:'usuario apellido'},
                    { data: 'Segundo_Apellido', name:'usuario apellido 2'},
                    { data: 'Primer_Nombre', name:'usuario nombre'},
                    { data: 'Segundo_Nombre', name:'usuario nombre 2'},
                    { data: 'Nombre_Acudiente', name:'Acudiente'},
                    { data: 'Email_Acudiente', name:'mail acudiente'},
                    { data: 'Telefono_Acudiente', name:'telefono acudiente'},
                    { data: 'Nombre_Usuario', name:'nombre usuario'},
                    { data: 'Nombre_Tipo_Documento_Usuario', name:'Tipo documento'},
                    { data: 'Documento_Usuario', name:'decumento'},
                    { data: 'Genero_Usuario', name:'genero'},
                    { data: 'Edad_Usuario', name:'edad'},
                    { data: 'CB_Usuario', name:''},
                    { data: 'Hora_Inicio_Usuario', name:'H inicio'},
                    { data: 'Hora_Fin_Usuario', name:'H fin'},
                    { data: 'Destreza_Inicial_Usuario', name:'destreza'},
                    { data: 'Avance_Logrado_Usuario', name:'avance'},
                    { data: 'Observaciones_Usuario', name:'observacion'}

                ]


            });



    });


});