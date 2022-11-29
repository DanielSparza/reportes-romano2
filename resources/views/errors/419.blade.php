@extends('app')
@section('title', '419: Página expirada')

@section('content')
<section class="cuerpo mb-4">
    <div class="container not-found">
        <div class="not-found-content">
            <img src="{!! asset('img/errors/419.jpg') !!}">
            <h1>ERROR: <span>Tiempo de espera agotado.</span></h1>
            <a href="/">regresar a la página principal.</a>
        </div>
    </div>
</section>
@endsection