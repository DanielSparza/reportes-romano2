@extends('app')
@section('title', '429: Demasiadas solicitudes')

@section('content')
<section class="cuerpo mb-4">
    <div class="container not-found">
        <div class="not-found-content">
            <img src="{!! asset('img/errors/429.jpg') !!}">
            <h1>ERROR: <span>Demasiadas solicitudes.</span></h1>
            <a href="/">regresar a la página principal.</a>
        </div>
    </div>
</section>
@endsection