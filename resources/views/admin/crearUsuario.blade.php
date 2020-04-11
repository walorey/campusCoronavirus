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
		    Crear usuario
		  </div>
		  <div class="card-body">
			<form action="{{route('users.store')}}"  method="post">
			  @csrf
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nombre</label>
			    <input type="text"  name="name" class="form-control" value="{{old('name')}}" placeholder="Primer nombre">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Apellido</label>
			    <input type="text"  name="lastname" class="form-control" value="{{old('lastname')}}" placeholder="Apellido">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Email</label>
			    <input type="email"  name="email" class="form-control" value="{{old('email')}}" placeholder="nombre@ejemplo.com">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect1">Tipo</label>
			    <select class="form-control" name="type" id="exampleFormControlSelect1">
			      <option disabled selected>Seleccionar</option>
			      <option value="admin">Administrador</option>
			      <option value="member">Cliente</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Contraseña</label>
			    <input type="password"  name="password" class="form-control">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Reingrese la contraseña</label>
			    <input type="password"  name="password_confirmation" class="form-control">
			  </div>
			  <button type="submit" class="btn btn-success">Guardar</button>
			</form>
		  </div>
		</div>

		<br>

		<a href="{{route('admin.home')}}"><button type="button" class="btn btn-secondary btn-sm">Volver</button></a>

	</div>
@endsection

