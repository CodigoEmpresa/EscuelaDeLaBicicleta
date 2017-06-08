<div class="content">
    <div id="main" class="row">
        @if ($status == 'success')
            <div id="alerta" class="col-xs-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Datos actualizados satisfactoriamente.
                </div>                                
            </div>
        @endif
        <div class="col-xs-12">
            <a class="btn btn-primary" href="{{ url('jornadas/formulario') }}">Crear</a>
        </div>
        <div class="col-xs-12"><br></div>
        <div class="col-xs-12">
            Total de jornadas encontradas: {{ count($elementos) }}
        </div>
        <div class="col-md-12"><br></div>
        <form action="{{ url('/jornadas') }}" method="post">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="">Parque</label>
                        <select name="parque" id="parque" title="Parque" class="form-control" data-value="{{ old('parque') }}">
                            <option value="Todos">Todos</option>
                            @foreach($parques as $parque)
                                <option value="{{ $parque['Id'] }}">{{ $parque['Nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Desde</label>
                        <input name="desde" type="text" placeholder="Desde" class="form-control" data-role="datepicker" data-rel="fecha_inicio" data-fecha-inicio="" data-fecha-fin="" data-fechas-importantes="{{ Festivos::create()->datesToString() }}" value="{{ old('desde') }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">Hasta</label>
                        <input name="hasta" type="text" placeholder="Hasta" class="form-control" data-role="datepicker" data-rel="fecha_fin" data-fecha-inicio="" data-fecha-fin="" data-fechas-importantes="{{ Festivos::create()->datesToString() }}" value="{{ old('hasta') }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="">&nbsp;</label><br>
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-xs-12"><hr></div>
        <div class="col-xs-12"><br></div>
        @if (count($elementos) > 0)
            <div class="col-xs-12">
                 <table class="default display no-wrap responsive table table-min table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>
                                Cod.
                            </th>
                            <th>
                                Fecha
                            </th>
                            <th>
                                Parque
                            </th>
                            <th data-priority="2" class="no-sort" style="width: 30px;">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($elementos as $jornada)
                            <tr>
                                <td style="text-align: center;" width=60>
                                    {{ $jornada->getCode() }}
                                </td>
                                <td>
                                    {{ $jornada->Fecha }}
                                </td>
                                <td>
                                    {{ $jornada->parque['Nombre'] }}
                                </td>
                                <td>
                                    <a href="{{ url('jornadas/formulario/'.$jornada->Id_Jornada) }}" class="pull-right btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>