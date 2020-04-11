@extends('layouts.app')

@section('content')

	<div class="container">

		@if ($errors->any())
	    <div class="alert alert-danger fade show">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
		@endif

		<div class="card">
		  <div class="card-header">
		    Editar usuario
		  </div>
		  <div class="card-body">
			<form action="{{route('users.update', $usuario->id)}}"  method="post">
			  @method('PUT')
			  @csrf
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nombre</label>
			    <input type="text"  name="name" class="form-control" value="{{$usuario->name}}" placeholder="Primer nombre">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Apellido</label>
			    <input type="text"  name="lastname" class="form-control" value="{{$usuario->lastname}}" placeholder="Apellido">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Email</label>
			    <input type="email"  name="email" class="form-control" value="{{$usuario->email}}" placeholder="nombre@ejemplo.com">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect1">Tipo</label>
			    <select class="form-control" name="type" id="exampleFormControlSelect1">
                  @if($usuario->type == 'admin')
                  <option value="admin" selected>Administrador</option>
                  @else
                  <option value="member" selected>Cliente</option>
                  @endif
			      <option disabled>Seleccionar</option>
			      <option value="admin">Administrador</option>
			      <option value="member">Cliente</option>
			    </select>
			  </div>
			  <button type="submit" class="btn btn-warning">Guardar cambios</button>
			</form>
		  </div>
		</div>

		<br>

		<div class="card">
		  <div class="card-header">
		    Blanquear contraseña
		  </div>
		  <div class="card-body">
			<form action="{{route('blanquear.password', $usuario->id)}}"  method="post">
			  @csrf
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Contraseña nueva</label>
			    <input type="password"  name="password" class="form-control">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Reingrese la contraseña</label>
			    <input type="password"  name="password_confirmation" class="form-control">
			  </div>
			  <button type="submit" class="btn btn-warning">Blanquear</button>
			</form>
		  </div>
		</div>

		<br>

		<a href="{{route('admin.home')}}"><button type="button" class="btn btn-secondary btn-sm">Volver</button></a>

	</div>
@endsection

