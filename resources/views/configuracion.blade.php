@extends('layouts.app')
@section('content')
	<div class="container">
		{{-- para la proxima meter alertas en un include y ordenarlas por mensaje/error/edicion --}}
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
		@if (session('error'))
	    <div class="alert alert-danger fade show">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>
	        <ul>
				{{session('error')}}
	        </ul>
	    </div>
		@endif
		<div class="row justify-content-center">
        	<div class="col-md-8">
				<div class="card">
		            <div class="card-header">Configuración</div>
					<div class="card-body">
						<h4>Cambiar email</h4>
						<form action="{{route('cambiar.email.config')}}" method="post">
							@csrf
							<div class="form-group">
							    <label for="exampleFormControlInput1">Email</label>
							    <input type="email" value="{{Auth::user()->email}}" class="form-control" name="email" placeholder="name@example.com">
							</div>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</form>
						<br>
						<h4>Cambiar contraseña</h4>
						<form action="{{route('modificar.password.config')}}" method="post">
							@csrf
							<div class="form-group">
							    <label for="exampleInputPassword1">Contraseña actual</label>
							    <input type="password" name="password_actual" class="form-control" required>
							</div>
							<div class="form-group">
							    <label for="exampleInputPassword1">Contraseña nueva</label>
							    <input type="password" class="form-control" name="password" required>
							</div>
							<div class="form-group">
						    	<label for="exampleInputPassword1">Reingrese contraseña</label>
						    	<input type="password" class="form-control" name="password_confirmation" required>
						  	</div>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection