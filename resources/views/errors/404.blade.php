@extends('app')
@section('title', '404: Página no encontrada')

@section('content')
<section class="cuerpo mb-4">
    <div class="container not-found">
        <div class="not-found-content">
            <img src="{!! asset('img/errors/404-not-found.jpg') !!}">
            <h1>ERROR: <span>Página no encontrada.</span></h1>
            <a href="/">regresar a la página principal.</a>
        </div>
    </div>
</section>
@endsection