@extends('app')
@section('title', '503: No disponible')

@section('content')
<section class="cuerpo mb-4">
    <div class="container not-found">
        <div class="not-found-content">
            <img src="{!! asset('img/errors/503.jpg') !!}">
            <h1>ERROR: <span>No se pudo procesar la solicitud.</span></h1>
            <a href="/">regresar a la página principal.</a>
        </div>
    </div>
</section>
@endsection