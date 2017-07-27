@extends('master-formularios')
@section('content')
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
    <form name="form_busqueda_reporte" action="fecha_reporte" method="post">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 form-group">
                    <label for="">Desde</label>
                    <input name="fechai" type="text" placeholder="Desde" class="form-control" data-role="datepicker" data-rel="fecha_inicio" data-fecha-inicio="" data-fecha-fin="" data-fechas-importantes="{{ Festivos::create()->datesToString() }}" value="{{ old('desde') }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="">Hasta</label>
                    <input name="fechaf" type="text" placeholder="Hasta" class="form-control" data-role="datepicker" data-rel="fecha_fin" data-fecha-inicio="" data-fecha-fin="" data-fechas-importantes="{{ Festivos::create()->datesToString() }}" value="{{ old('hasta') }}">
                </div>
                <div class="col-md-2 form-group">
                    <label for="">&nbsp;</label><br>
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-success">Reporte</button>
                </div>
            </div>
        </div>
    </form>

    <div class="col-md-12">
        <table class="datatable">
            <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Clima</th>
                <th>Nombre_Encargado</th>
                <th>Observaciones_Generales</th>
                <th>Cedula</th>
                <th>Primer_Apellido</th>
                <th>Segundo_Apellido</th>
                <th>Primer_Nombre</th>
                <th>Segundo_Nombre</th>
                <th>Nombre_Acudiente</th>
                <th>Email_Acudiente</th>
                <th>Telefono_Acudiente</th>
                <th>Nombre_Usuario</th>
                <th>Nombre_Tipo_Documento_Usuario</th>
                <th>Documento_Usuario</th>
                <th>Genero_Usuario</th>
                <th>Edad_Usuario</th>
                <th>CB_Usuario</th>
                <th>Hora_Inicio_Usuario</th>
                <th>Hora_Fin_Usuario</th>
                <th>Destreza_Inicial_Usuario</th>
                <th>Avance_Logrado_Usuario</th>
                <th>Observaciones_Usuario</th>



            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script src="{{ asset('public/Js/reporte.js') }}"></script>
@stop
