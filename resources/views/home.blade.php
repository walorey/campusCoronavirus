@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido!</div>

                <div class="card-body">
                    <div class="btn-group">
                        <a href="{{route('foro.index')}}">
                            <button class="btn btn-success btn-lg" type="button">
                                Foro
                            </button>
                        </a>
                    </div>
                                        <div class="btn-group">
                        <a href="{{route('materialDidactico')}}">
                            <button class="btn btn-dark btn-lg" type="button">
                                Material didáctico
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
