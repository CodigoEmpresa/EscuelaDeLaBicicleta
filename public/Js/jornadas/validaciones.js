$(function()
{
    $('input[name="Acudiente_Es_Usuario"]').on('click', function(e)
    {
        if($(this).is(':checked'))
        {
            $('input[name="Nombre_Acudiente"]').val($('input[name="Nombre_Usuario"]').val());
        }
    });

    $('input[name="Nombre_Usuario"]').on('keyup', function(e)
    {
        if($('input[name="Acudiente_Es_Usuario"]').is(':checked'))
        {
            $('input[name="Nombre_Acudiente"]').val($(this).val());
        }
    });

    $('input[name="Edad_Usuario"]').on('change', function(e)
    {
        var edad = parseInt($(this).val());
        var cb = '';

        if (edad < 6) {cb = 'P.I';}
        else if (edad < 12) {cb = "I";}
        else if (edad < 18) {cb = "ADO";}
        else if (edad < 60) {cb = "ADU";}
        else if (edad > 60) {cb = "VE";}

        $('select[name="CB_Usuario"]').val(cb).trigger('change');
    });

    $('input[name="Documento_Usuario"]').on('blur', function(e)
    {
        var key = $(this).val();

        if (key)
        {
           $.post(
               $(this).data('url'),
               {
                   'key': key
               },
               'json'
           ).done(function(user) {
               if(!$.isEmptyObject(user))
               {
                   $('input[name="Nombre_Usuario"]').val(user.Nombre_Usuario);
                   $('input[name="Edad_Usuario"]').val(user.Edad_Usuario).trigger('change');
                   $('input[name="Genero_Usuario"][value="'+user.Genero_Usuario+'"]').trigger('click');
               }
           });
        }
    });
});