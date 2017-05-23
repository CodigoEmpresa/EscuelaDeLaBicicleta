@section('script')
    @parent

    <script src="{{ asset('public/Js/jornadas/formulario.js') }}"></script>
@stop

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
        @if (!empty($errors->all()))
            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Solucione los siguientes inconvenientes y vuelva a intentarlo</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="col-xs-12"><br></div>
        <div class="col-xs-12">
            <div class="row">
                <form action="{{ url('jornadas/procesar') }}" method="post">
                    <fieldset>
						<div class="col-md-3 form-group {{ $errors->has('Id_Parque') ? 'has-error' : '' }}">
							<label for="" class="control-label">Parque</label>
							<select class="form-control" name="Id_Parque" id="" title="Seleccionar" data-value="{{ $jornada ? $jornada['Id_Parque'] : old('Id_Parque') }}">
								@foreach($parques as $parque)
									<option value="{{ $parque['Id'] }}">{{ $parque['Nombre'] }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3 form-group {{ $errors->has('Clima') ? 'has-error' : '' }}">
							<label for="" class="control-label">Clima</label>
							<select class="form-control" name="Clima" id="" title="Seleccionar" data-value="{{ $jornada ? $jornada['Clima'] : old('Clima') }}">
								<option value="Lluvioso">Lluvioso</option>
								<option value="Soleado">Soleado</option>
							</select>
						</div>
						<div class="col-md-3 form-group {{ $errors->has('Fecha') ? 'has-error' : '' }}">
							<label for="" class="control-label">Fecha</label>
							<input class="form-control" type="text" name="Fecha" data-role="datepicker" value="{{ $jornada ? $jornada['Fecha'] : old('Fecha') }}">
						</div>
						<div class="col-md-3 form-group {{ $errors->has('Nombre_Encargado') ? 'has-error' : '' }}">
							<label for="" class="control-label">Encargado(s) <small>separados por " , "</small></label>
							<input class="form-control" type="text" name="Nombre_Encargado" value="{{ $jornada ? $jornada['Nombre_Encargado'] : old('Nombre_Encargado', $promotor->persona->toFriendlyString()) }}">
						</div>
                        <div class="col-xs-12">
                            <hr>
                        </div>
                		<div class="col-xs-12">
                			<h5>Usuarios</h5>
                		</div>
                        <div class="col-xs-12 col-xs-12">
                        	<a id="agregar" href="#" class="btn btn-default">Agregar</a>
                        </div>
                        <div class="col-xs-12">
                        	<br>
                        </div>
                        <div class="col-md-12 col-xs-12">
                        	<table class="table table-min default">
                        		<thead>
                        			<tr>
                        				<th>Usuario</th>
                        				<th width="30px	" style="width: 30px;" class="no-sort"></th>
                        			</tr>
                        		</thead>
                        	</table>
                        </div>
                        <div class="col-xs-12">
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="Usuarios" value="">
                            <input type="hidden" name="Id_Jornada" value="{{ $jornada ? $jornada['Id_Jornada'] : 0 }}">
                            <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                            @if ($jornada)
                                <a data-toggle="modal" data-target="#modal-eliminar" class="btn btn-danger">Eliminar</a>
                            @endif
                            <a href="{{ url('jornadas') }}" class="btn btn-default">Volver</a>
                        </div>
                        <div class="col-xs-12"><br></div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-agregar" data-url="{{ url('personas') }}" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg " role="document">
		<form>
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title">Usuario</h4>
	            </div>
	            <div class="modal-body">
	            	<div class="row">
            			<div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Cedula">* Documento </label>
                                <input type="text" name="Cedula" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Id_TipoDocumento">* Tipo documento </label>
                                <select name="Id_TipoDocumento" id="" class="form-control" data-value="" title="Seleccionar">
                                    @foreach($documentos as $documento)
                                        <option value="{{ $documento['Id_TipoDocumento'] }}">{{ $documento['Descripcion_TipoDocumento'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Primer_Nombre">* Primer nombre </label>
                                <input type="text" name="Primer_Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Segundo_Nombre">Segundo nombre </label>
                                <input type="text" name="Segundo_Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Primer_Apellido">* Primer apellido </label>
                                <input type="text" name="Primer_Apellido" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Segundo_Apellido">Segundo apellido </label>
                                <input type="text" name="Segundo_Apellido" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12"><hr></div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Fecha_Nacimiento">* Fecha de nacimiento </label>
                                <input type="text" name="Fecha_Nacimiento" data-role="datepicker" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Id_Etnia">* Etnia </label>
                                <select name="Id_Etnia" id="" class="form-control" data-value="" title="Seleccionar">
                                    @foreach($etnias as $etnia)
                                        <option value="{{ $etnia['Id_Etnia'] }}">{{ $etnia['Nombre_Etnia'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Id_Genero">* Género</label><br>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="radio" name="Id_Genero" value="1" autocomplete="off"> <span class="text-success">M</span>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="Id_Genero" value="2" autocomplete="off"> <span class="text-danger">F</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12"><hr></div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Id_Genero">* Acudiente</label><br>
                                <input class="form-control" type="text" name="Acudiente">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Id_Pais">* País </label>
                                <select name="Id_Pais" id="" class="form-control" data-value="" data-live-search="true" title="Seleccionar">
                                    @foreach($paises as $pais)
                                        <option value="{{ $pais['Id_Pais'] }}">{{ $pais['Nombre_Pais'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Nombre_Ciudad">Ciudad </label>
                                <select name="Nombre_Ciudad" id="" class="form-control" data-value="" data-live-search="true" title="Seleccionar">
                                </select>
                            </div>
                        </div>
            		</div>
	            </div>
	            <div class="modal-footer">
	                <a href="{{ url('jornadas/'.$jornada['Id_Persona'].'/eliminar') }}" class="btn btn-danger">Eliminar</a>
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	            </div>
	        </div>
        </form>
    </div>
</div>
@if ($jornada)
    <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar</h4>
                </div>
                <div class="modal-body">
                    <p>Realmente desea eliminar esta jornada.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('jornadas/'.$jornada['Id_Persona'].'/eliminar') }}" class="btn btn-danger">Eliminar</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endif
