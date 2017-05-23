$(function()
{
	var URL = $('#modal-agregar').data('url');

	function popular_ciudades(id)
    {
        $.ajax({
            url: URL+'/service/ciudad/'+id,
            data: {},
            dataType: 'json',
            success: function(data)
            {
                var html = '';
                if(data.length > 0)
                {
                    $.each(data, function(i, e)
                    {
                        html += '<option value="'+e['Nombre_Ciudad']+'">'+e['Nombre_Ciudad']+'</option>';
                    });
                }
                $('select[name="Nombre_Ciudad"]').html(html);
                $('select[name="Nombre_Ciudad"]').selectpicker('refresh');
                $('select[name="Nombre_Ciudad"]').selectpicker('val', $('select[name="Nombre_Ciudad"]').data('value'));

            }
        });
    }

	function popular_acudiente(persona)
	{
        $('select[name="Id_TipoDocumento"]').val(persona['Id_TipoDocumento']);
        $('input[name="Cedula"]').val($.trim(persona['Cedula']));
        $('input[name="Primer_Apellido"]').val($.trim(persona['Primer_Apellido']));
        $('input[name="Segundo_Apellido"]').val(persona['Segundo_Apellido']);
        $('input[name="Primer_Nombre"]').val($.trim(persona['Primer_Nombre']));
        $('input[name="Segundo_Nombre"]').val($.trim(persona['Segundo_Nombre']));
        $('input[name="Fecha_Nacimiento"]').val($.trim(persona['Fecha_Nacimiento']));
        $('select[name="Id_Etnia"]').val(persona['Id_Etnia']);
        $('select[name="Nombre_Ciudad"]').data('value', persona['Nombre_Ciudad']);
        $('select[name="Id_Pais"]').val(persona['Id_Pais']).trigger('change');
        $('input[name="Id_Persona"]').val(persona['Id_Persona']);
        $('input[name="Id_Genero"]').removeAttr('checked').parent('.btn').removeClass('active');
        $('input[name="Id_Genero"][value="'+persona['Id_Genero']+'"]').trigger('click');
        $('#modal-agregar').modal('show');
        $("#agregar").button('reset');
    }

	$('#agregar').on('click', function(e)
	{
        $("#agregar").button('loading');

        var persona = {
            Id_TipoDocumento: '',
            Cedula: '',
            Primer_Apellido: '',
            Segundo_Apellido: '',
            Primer_Nombre: '',
            Segundo_Nombre: '',
            Fecha_Nacimiento: '',
            Id_Etnia: '',
            Id_Pais: 41,
            Nombre_Ciudad: '',
            Id_Persona: 0,
            Id_Genero: 0
        }

        popular_modal_persona(persona);
    });

    $('select[name="Id_Pais"]').on('changed.bs.select', function(e)
    {
        if($('select[name="Id_Pais"]').selectpicker('val'))
            popular_ciudades($('select[name="Id_Pais"]').selectpicker('val'));
    });
});