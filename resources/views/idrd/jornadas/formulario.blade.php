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
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Usuario</h4>
            </div>
            <div class="modal-body">
            	<div class="row">
                    <form id="form-acudiente" action="{{ url() }}">
                        <div class="col-xs-12">
                            <h5>Acudiente</h5>
                        </div>
            			<div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Cedula">* Documento </label>
                                <input type="text" name="Acudiente_Cedula" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Id_TipoDocumento">* Tipo documento </label>
                                <select name="Acudiente_Id_TipoDocumento" id="" class="form-control" data-value="" title="Seleccionar">
                                    @foreach($documentos as $documento)
                                        <option value="{{ $documento['Id_TipoDocumento'] }}">{{ $documento['Descripcion_TipoDocumento'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Fecha_Nacimiento">* Fecha de nacimiento </label>
                                <input type="text" name="Acudiente_Fecha_Nacimiento" data-role="datepicker" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Id_Genero">* Género</label><br>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="radio" name="Acudiente_Id_Genero" value="1" autocomplete="off"> <span class="text-success">M</span>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="Acudiente_Id_Genero" value="2" autocomplete="off"> <span class="text-danger">F</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Primer_Nombre">* Primer nombre </label>
                                <input type="text" name="Acudiente_Primer_Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Segundo_Nombre">Segundo nombre </label>
                                <input type="text" name="Acudiente_Segundo_Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Primer_Apellido">* Primer apellido </label>
                                <input type="text" name="Acudiente_Primer_Apellido" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Segundo_Apellido">Segundo apellido </label>
                                <input type="text" name="Acudiente_Segundo_Apellido" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Teléfono">Teléfono </label>
                                <input type="text" name="Acudiente_Teléfono" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="Acudiente_Email">Email </label>
                                <input type="text" name="Acudiente_Email" class="form-control" value="">
                                <input type="hidden" name="Acudiente_Id_Etnia" value="7">
                                <input type="hidden" name="Acudiente_Id_Pais" value="41">
                                <input type="hidden" name="Acudiente_Ciudad" value="Bogotá">
                                <input type="hidden" name="Id_Acudiente" value="0">
                            </div>
                        </div>
                        <div class="col-xs-12"><hr></div>
                    </form>
                    <form id="#form-usuario" action="">
                        <div class="col-xs-12">
                            <h5>Usuario</h5>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Cedula">* Documento </label>
                                <input type="text" name="Usuario_Cedula" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Id_TipoDocumento">* Tipo documento </label>
                                <select name="Usuario_Id_TipoDocumento" id="" class="form-control" data-value="" title="Seleccionar">
                                    @foreach($documentos as $documento)
                                        <option value="{{ $documento['Id_TipoDocumento'] }}">{{ $documento['Descripcion_TipoDocumento'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Fecha_Nacimiento">* Fecha de nacimiento </label>
                                <input type="text" name="Usuario_Fecha_Nacimiento" data-role="datepicker" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Id_Genero">* Género</label><br>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="radio" name="Usuario_Id_Genero" value="1" autocomplete="off"> <span class="text-success">M</span>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="Usuario_Id_Genero" value="2" autocomplete="off"> <span class="text-danger">F</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Primer_Nombre">* Primer nombre </label>
                                <input type="text" name="Usuario_Primer_Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Segundo_Nombre">Segundo nombre </label>
                                <input type="text" name="Usuario_Segundo_Nombre" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Primer_Apellido">* Primer apellido </label>
                                <input type="text" name="Usuario_Primer_Apellido" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Segundo_Apellido">Segundo apellido </label>
                                <input type="text" name="Usuario_Segundo_Apellido" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Ciclo_Biologico">* Ciclo biológico </label>
                                <select name="Usuario_Ciclo_Biologico" id="" class="form-control" data-value="" title="Seleccionar">
                                    <option value="P.I"> Primera infancia (0 - 5 años)</option>
                                    <option value="I"> Infancia (6 - 11 años)</option>
                                    <option value="ADO"> Adolescencia (12 - 17 años)</option>
                                    <option value="ADU"> Adultez (18 - 59 años)</option>
                                    <option value="VE"> Vejez (60 años o más)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <hr>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Observaciones">* Hora inicial </label>
                                <input type="text" name="Usuario_Hora_Inicial" class="form-control" data-role="clockpicker" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Hora_Inicial">* Hora final </label>
                                <input type="text" name="Usuario_Hora_Final" class="form-control" data-role="clockpicker" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Destreza_Inicial">* Destreza inicial </label>
                                <select name="Usuario_Ciclo_Biologico" id="" class="form-control" data-value="" title="Seleccionar">
                                    <option value="A">No sabe montar bicicleta</option>
                                    <option value="B">Pedalea con ruedas de entrenamiento</option>
                                    <option value="C">Camina con la bicicleta</option>
                                    <option value="D">Se impulsa y mantiene el equilibrio</option>
                                    <option value="E">Pedalea con apoyo</option>
                                    <option value="F">Pedalea y mantiene equilibro por instantes</option>
                                    <option value="G">Maneja la bicicleta con apoyo</option>
                                    <option value="H">Maneja</option>
                                    <option value="I">Maneja y adquiere otras habilidades con la bicicleta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Destreza_Inicial">* Avance logrado </label>
                                <select name="Usuario_Ciclo_Biologico" id="" class="form-control" data-value="" title="Seleccionar">
                                    <option value="A">No sabe montar bicicleta</option>
                                    <option value="B">Pedalea con ruedas de entrenamiento</option>
                                    <option value="C">Camina con la bicicleta</option>
                                    <option value="D">Se impulsa y mantiene el equilibrio</option>
                                    <option value="E">Pedalea con apoyo</option>
                                    <option value="F">Pedalea y mantiene equilibro por instantes</option>
                                    <option value="G">Maneja la bicicleta con apoyo</option>
                                    <option value="H">Maneja</option>
                                    <option value="I">Maneja y adquiere otras habilidades con la bicicleta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="Usuario_Observaciones">Observaciones </label>
                                <textarea name="Usuario_Observaciones" class="form-control"></textarea>
                                <input type="hidden" name="Usuario_Id_Etnia" value="7">
                                <input type="hidden" name="Usuario_Id_Pais" value="41">
                                <input type="hidden" name="Usuario_Ciudad" value="Bogotá">
                                <input type="hidden" name="Id_Usuario" value="0">
                            </div>
                        </div>
                    </form>
            	</div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Guardar">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
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
