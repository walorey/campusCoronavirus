@extends('layouts.app')
@section('styles')
	   <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div class="container">
		<!-- Image and text -->
		<nav class="navbar navbar-light bg-success rounded">
		  <a class="navbar-brand text-light" href="{{route('foro.index')}}">
		    <img src="{{asset('img/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
		    Foro
		  </a>
		  <h3 class="text-light">Mis preguntas</h3>
		</nav>
		<br>

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="card bg-light mb-3" style="max-width: 21rem;">
				  <div class="card-header text-center">Menú</div>
				  <div class="card-body">
					<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#preguntar">Hacer una pregunta</button>
						<br>
					<a href="{{route('misPreguntas')}}" class="link-limpio-blanco">
						<button type="button" class="btn btn-info btn-block">Mis preguntas</button>
					</a>
				  </div>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				@if(Auth::user()->questions->count()>0)
					@foreach(Auth::user()->questions as $pregunta)
						<div class="card text-white bg-info mb-3">
						  <div class="card-header">
						  	<span>{{$pregunta->user->name.' '.$pregunta->user->lastname}}</span>
						  		<span class="float-right">
							  	  <div class="dropdown no-arrow">
				                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
				                    </a>
				                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
				                      <a class="dropdown-item text-center" href="{{route('foro.edit', $pregunta->id)}}">Editar</a>
				                      <div class="dropdown-divider"></div>
				                      <a class="dropdown-item text-center" type="button" data-toggle="modal" data-target="#modalBorrar{{$pregunta->id}}">Eliminar</a>
				                    </div>
				                  </div>
							  	</span>
						  	<span class="float-right">
						  		{{$pregunta->created_at}}
						  	</span>
						  </div>
						  <div class="card-body">
						    <h5 class="card-title">{{$pregunta->titulo}}</h5>
						 </div>
						 <div class="card-footer">
						 	<a href="{{route('foro.show', $pregunta->id)}}" class="link-limpio-blanco">Ver</a>
						 </div>
						</div>



												<!-- Modal borrar -->
						<div class="modal fade" id="modalBorrar{{$pregunta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">¿Borrar pregunta?</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-footer">
						      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						      	<form class="d-inline" method="post" action="{{route('foro.destroy', $pregunta->id)}}">
									@method('DELETE')
									@csrf
									<button type="submit" class="btn btn-danger">Borrar</button>
								</form>


						      </div>
						    </div>
						  </div>
						</div>
					@endforeach
					<br>
				@else
					<h3>Aún no hay preguntas, si tienes dudas puedes hacer una!</h3>
				@endif
			</div>
		</div>
	</div>
	<!-- Modal hacer una pregunta-->
	<div class="modal fade" id="preguntar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">¿Cuál es tu duda?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="{{route('foro.store')}}" method="post" id="formPregunta">
	        	@csrf
	        	<div class="form-group">
			   		<label>Pregunta</label>
			    	<input type="text" class="form-control" required name="titulo">
			  	</div>
			  	<div class="form-group">
			  		<label for="exampleFormControlTextarea1">Detalles</label>
    				<textarea class="form-control" required name="cuerpo" rows="3"></textarea>
			  	</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary" form="formPregunta">Preguntar</button>
	      </div>
	    </div>
	  </div>
	</div>
@endsection