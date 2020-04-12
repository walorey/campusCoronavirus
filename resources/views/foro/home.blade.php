@extends('layouts.app')
@section('styles')
	   <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
@endsection
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
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="card bg-light mb-3" style="max-width: 21rem;">
				  <div class="card-header text-center">Menú</div>
				  <div class="card-body">
					<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#preguntar">Hacer una pregunta</button>
						<br>
					<button type="button" class="btn btn-info btn-block">Mis preguntas</button>
				  </div>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				@if($preguntas->count()>0)
					@foreach($preguntas as $pregunta)
						<div class="card text-white bg-info mb-3">
						  <div class="card-header">
						  	<span>{{$pregunta->user->name.' '.$pregunta->user->lastname}}</span>
						  	<span>|</span>
						  	<span>{{$pregunta->created_at}}</span>

						  </div>
						  <div class="card-body">
						    <h5 class="card-title">{{$pregunta->titulo}}</h5>
						 </div>
						 <div class="card-footer">
						 	<a href="{{route('foro.show', $pregunta)}}" class="link-limpio-blanco">Ver</a>
						 </div>
					@endforeach
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