@extends('app')
@section('title', '403: No autorizado.')

@section('content')
<section class="cuerpo mb-4">
    <div class="container not-found">
        <div class="not-found-content">
            <img src="{!! asset('img/errors/403.jpg') !!}">
            <h1>ERROR: <span>No autorizado.</span></h1>
            <a href="/">regresar a la página principal.</a>
        </div>
    </div>
</section>
@endsection