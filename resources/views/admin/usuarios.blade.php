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
		@if (session('usuarioBorrado'))
	    <div class="alert alert-danger fade show">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
	        <ul>
				{{session('usuarioBorrado')}}
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
			<div class="card-header">Usuarios</div>
			<div class="table-responsive">
				<table class="table">
				  	<thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Nombre</th>
					      <th scope="col">Apellido</th>
					      <th scope="col">Email</th>
					      <th scope="col">Tipo</th>
					      <th scope="col">Editar/Eliminar</th>
					    </tr>
					</thead>
					<tbody>
						@foreach($usuarios as $usuario)
					    <tr>
					      <th scope="row">{{$usuario->id}}</th>
					      <td>{{$usuario->name}}</td>
					      <td>{{$usuario->lastname}}</td>
					      <td>{{$usuario->email}}</td>
					      <td>
					      	@if($usuario->type == 'admin')
					      		<span class="badge badge-primary">Admin</span>
					      	@else
					      		<span class="badge badge-danger">Cliente</span>
					      	@endif
					      </td>
					      <td>
					      	<span>
					      	<a href="{{route('users.edit', $usuario->id)}}">
					      		<button type="button" class="btn btn-warning" title="Editar"><i class="fas fa-pencil-alt"></i></button>
					      	</a>
					      	</span>
					      	<span class="float-right">
					      	<form class="d-inline" method="post" action="{{route('users.destroy', $usuario->id)}}">
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

		{!! $usuarios->render()!!}

		<br>
		<a href="{{route('admin.home')}}"><button type="button" class="btn btn-secondary btn-sm">Volver</button></a>
	</div>
@endsection