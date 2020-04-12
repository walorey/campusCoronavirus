@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="card bg-light mb-3">
		  <div class="card-header">
		  	{{$pregunta->user->name.' '.$pregunta->user->lastname}}

		  	@if(Auth::user()->type == 'admin' || Auth::user()->id == $pregunta->user->id)
		  		<span class="float-right">
			  	  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      @if(Auth::user()->id == $pregunta->user->id)
                      <a class="dropdown-item text-center" href="{{route('foro.edit', $pregunta->id)}}">Editar</a>
                      <div class="dropdown-divider"></div>
                      @endif
                      <a class="dropdown-item text-center" type="button" data-toggle="modal" data-target="#modalBorrar">Eliminar</a>
                    </div>
                  </div>
			  	</span>
		  	@endif
		  	<span class="float-right">
		  		{{$pregunta->created_at}}
		  	</span>
		  </div>
		  <div class="card-body">
		    <h5 class="card-title">{{$pregunta->titulo}}</h5>
		    <p class="card-text">{{$pregunta->cuerpo}}</p>
		  </div>
		</div>
		<br>
		<h3>Comentarios</h3>
		@foreach($pregunta->comments as $comentario)
		<div class="card border-light mb-3">
		  <div class="card-header">{{$comentario->user->name.' '.$comentario->user->lastname}}</div>
		  <div class="card-body">
		    <p class="card-text">{{$comentario->cuerpo}}</p>
		  </div>
		</div>
		@endforeach
		@if(Auth::user()->type == 'admin')
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
		<div class="card bg-light mb-3">
		  <div class="card-header">Comentar</div>
		  <div class="card-body">
		  	<form action="{{route('comentar.store', $pregunta->id)}}" method="post" id="formComentario">
		  		@csrf
			  <div class="form-group">
			    <textarea class="form-control" name="cuerpo" rows="3" required=""></textarea>
			  </div>
			</form>
		  </div>
		  <div class="card-footer">
		  	<span class="float-right">
		  	<button type="submit" class="btn btn-outline-primary btn-sm" form="formComentario">Enviar</button>
		  	</span>
		  </div>
		</div>
		@endif
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endsection