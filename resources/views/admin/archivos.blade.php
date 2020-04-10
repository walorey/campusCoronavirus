@extends('layouts.app')

@section('content')
	<div class="container">
		@if (session('mensaje'))
	    <div class="alert alert-success fade show">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
	        <ul>
				{{session('mensaje')}}
	        </ul>
	    </div>
		@endif
		@if (session('archivoBorrado'))
	    <div class="alert alert-danger fade show">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
	        <ul>
				{{session('archivoBorrado')}}
	        </ul>
	    </div>
		@endif
		@if (session('edicion'))
	    <div class="alert alert-warning fade show">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
	        <ul>
				{{session('edicion')}}
	        </ul>
	    </div>
		@endif
		<div class="card">
			<div class="card-header">Archivos</div>
			<div class="table-responsive">
				<table class="table">
				  	<thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Título</th>
					      <th scope="col">Descripción</th>
					      <th scope="col">Módulo</th>
					      <th scope="col">Enlace</th>
					      <th scope="col">Editar/Eliminar</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($archivos as $archivo)
					    <tr>
					      <th scope="row">{{$archivo->id}}</th>
					      <td>{{$archivo->name}}</td>
					      <td>{{$archivo->descripcion}}</td>
					      <td>{{$archivo->modulo}}</td>
					      <td><a href="{{asset($archivo->ruta)}}" target="_blank">Ver</a></td>
					      <td>
					      	<span>
					      	<a href="{{route('files.edit', $archivo)}}">
					      		<button type="button" class="btn btn-warning" title="Editar"><i class="fas fa-pencil-alt"></i></button>
					      	</a>
					      	</span>
					      	<span class="float-right">
					      	<form class="d-inline" method="post" action="{{route('files.destroy', $archivo->id)}}">
					      		@method('DELETE')
					      		@csrf
					      		<button type="submit" class="btn btn-danger" title="Eliminar" onclick="return confirm('Estas seguro que deseas eliminarlo?')"><i class="fas fa-trash-alt"></i></button>
					      	</form>
					      	</span>

					      </td>
					    </tr>
					    @endforeach
					</tbody>
				</table>
			</div>
		</div>

		{!! $archivos->render()!!}

		<br>
		<a href="{{route('admin.home')}}"><button type="button" class="btn btn-secondary btn-sm">Volver</button></a>
	</div>
@endsection