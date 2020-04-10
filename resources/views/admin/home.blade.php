@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
        	<div class="col-md-8">
				<div class="card">
		            <div class="card-header">Panel administrativo</div>
					<div class="card-body">
						<div class="btn-group">
						  <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Usuarios
						  </button>
						  <div class="dropdown-menu">
						    <a class="dropdown-item" href="#">Crear usuario</a>
						    <a class="dropdown-item" href="#">Ver usuarios</a>
						  </div>
						</div>
						<div class="btn-group">
						  <button class="btn btn-danger btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Archivos
						  </button>
						  <div class="dropdown-menu">
						    <a class="dropdown-item" href="{{route('subir.archivo')}}">Subir archivo</a>
						    <a class="dropdown-item" href="{{route('files.index')}}">Ver archivos</a>
						  </div>
						</div>
						<div class="btn-group">
						  <button class="btn btn-success btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Foro
						  </button>
						  <div class="dropdown-menu">
						    <a class="dropdown-item" href="#">Hacer una pregunta</a>
						    <a class="dropdown-item" href="#">Ver Preguntas</a>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection