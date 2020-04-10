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
		    Subir un archivo
		  </div>
		  <div class="card-body">
			<form action="{{route('files.store')}}" class="dropzone" enctype="multipart/form-data" method="post" id="formArchivo">
			  @csrf
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nombre del archivo</label>
			    <input type="text"  name="name" class="form-control" id="exampleFormControlInput1" placeholder="Introduccion, bibliografía, calificaciones, etc">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect1">Módulo</label>
			    <select class="form-control" name="modulo" id="exampleFormControlSelect1">
			      <option disabled selected>Seleccionar</option>
			      <option value="1">1</option>
			      <option value="2">2</option>
			      <option value="3">3</option>
			      <option value="4">4</option>
			      <option value="5">5</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlFile1">Carga un archivo</label>
			    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="archivo">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlTextarea1">Descripción</label>
			    <textarea class="form-control" id="exampleFormControlTextarea1" name="descripcion" rows="3"></textarea>
			  </div>
			  <button type="submit" form="formArchivo" class="btn btn-success">Subir</button>
			</form>
		  </div>
		</div>

		<br>

		<a href="{{route('admin.home')}}"><button type="button" class="btn btn-secondary btn-sm">Volver</button></a>

	</div>
@endsection

