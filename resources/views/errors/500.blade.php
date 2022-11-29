@extends('app')
@section('title', '500: Respuesta desconocida')

@section('content')
<section class="cuerpo mb-4">
    <div class="container not-found">
        <div class="not-found-content">
            <img src="{!! asset('img/errors/500.jpg') !!}">
            <h1>ERROR: <span>Respuesta desconocida.</span></h1>
            <a href="/">regresar a la página principal.</a>
        </div>
    </div>
</section>
@endsection