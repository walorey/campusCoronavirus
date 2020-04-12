@extends('layouts.app')
@section('content')
	<div class="container">
		<nav class="navbar navbar-light bg-dark rounded">
		  <a class="navbar-brand text-light" href="#">
		  	<span class="bg-light rounded">
		    	<img src="{{asset('img/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
		    </span>
		    Material didáctico
		  </a>
		</nav>
		<br>
		@for($i=1; $i<6; $i++)
		<div class="accordion" id="accordion{{$i}}">

		  <div class="card">
		    <div class="card-header" id="heading{{$i}}">
		      <h2 class="mb-0">
		        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
		          Módulo {{$i}}
		        </button>
		      </h2>
		    </div>

		    <div id="collapse{{$i}}" class="collapse show" aria-labelledby="heading{{$i}}" data-parent="#accordion{{$i}}">
		      <div class="card-body">
		      	<div class="card-group">
		      		@foreach($archivos as $archivo)
		      			@if($archivo->modulo == $i)
						  <div class="card">
						    <div class="card-body">
								<h5 class="card-title">{{$archivo->name}}</h5>
								<p class="card-text">{{$archivo->descripcion}}</p>
								<a href="{{asset($archivo->ruta)}}" class="btn btn-primary" target="_blank">Ver</a>
						    </div>
						  </div>
		      			@endif
		      		@endforeach
				</div>
		      </div>
		    </div>
		  </div>
		</div>
		@endfor

		<div class="accordion" id="accordionExamenes">
		  <div class="card">
		    <div class="card-header" id="headingExamenes">
		      <h2 class="mb-0">
		        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseExamenes" aria-expanded="true" aria-controls="collapseExamenes">
		          Exámenes
		        </button>
		      </h2>
		    </div>

		    <div id="collapseExamenes" class="collapse show" aria-labelledby="headingExamenes" data-parent="#accordionExamenes">
		      <div class="card-body">
				@foreach($archivos as $archivo)
					@if($archivo->modulo == 6)
					<div class="card-group">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">{{$archivo->name}}</h5>
								<p class="card-text">{{$archivo->descripcion}}</p>
								<a href="{{asset($archivo->ruta)}}" class="btn btn-primary" target="_blank">Ver</a>
							</div>
						</div>
					</div>
					@endif
				@endforeach
		      </div>
		    </div>
		  </div>
		</div>
	</div>
@endsection