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
				$_SESSION['Usuario']['Permisos']['administrar_jornadas']
			)
				<li class="dropdown {{ $seccion && in_array($seccion, ['Promotores']) ? 'active' : '' }}">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Administración <span class="caret"></span></a>
					<ul class="dropdown-menu">
						@if($_SESSION['Usuario']['Permisos']['administrar_promotores'])
							<li class="{{ $seccion && $seccion == 'Promotores' ? 'active' : '' }}">
								<a href="{{ url('promotores') }}">Promotores</a>
							</li>
						@endif
					</ul>
				</li>
				<li class="{{ $seccion && in_array($seccion, ['Gestores']) ? 'active' : '' }}">
					<a href="{{ url('jornadas') }}">Jornadas</a>
				</li>
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