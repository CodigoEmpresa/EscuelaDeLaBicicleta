<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="{{ url('/welcome') }}" data-role="{{ implode($_SESSION['Usuario']['Roles']) }}" class="navbar-brand">SIM</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
			@if (
				$_SESSION['Usuario']['Permisos']['administrar_promotores'] ||  
				$_SESSION['Usuario']['Permisos']['administrar_jornadas'] ||
				$_SESSION['Usuario']['Permisos']['administrar_reportes']
			)
				@if($_SESSION['Usuario']['Permisos']['administrar_promotores'])
					<li class="dropdown {{ $seccion && in_array($seccion, ['Promotores']) ? 'active' : '' }}">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Administración <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="{{ $seccion && $seccion == 'Promotores' ? 'active' : '' }}">
								<a href="{{ url('promotores') }}">Promotores</a>
							</li>
						</ul>
					</li>
				@endif
				@if($_SESSION['Usuario']['Permisos']['administrar_jornadas'])
					<li class="dropdown {{ $seccion && in_array($seccion, ['Buscar jornadas', 'Crear jornadas']) ? 'active' : '' }}">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Jornadas <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="{{ $seccion && in_array($seccion, ['Buscar jornadas']) ? 'active' : '' }}">
								<a href="{{ url('jornadas') }}">Buscar</a>
							</li>
							<li class="{{ $seccion && in_array($seccion, ['Crear jornadas']) ? 'active' : '' }}">
								<a href="{{ url('jornadas/formulario') }}">Crear</a>
							</li>
						</ul>
					</li>
				@endif
				@if($_SESSION['Usuario']['Permisos']['administrar_reportes'])
					<li class="{{ $seccion && in_array($seccion, ['Reportes']) ? 'active' : '' }}">
						<a href="{{ url('reportes') }}">Reportes</a>
					</li>
				@endif
			@endif
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="http://www.idrd.gov.co/sitio/idrd/" target="_blank">I.D.R.D</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					{{ $_SESSION['Usuario']['Persona']['Primer_Apellido'].' '.$_SESSION['Usuario']['Persona']['Primer_Nombre'] }}<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ url('logout') }}">Cerrar sesión</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>