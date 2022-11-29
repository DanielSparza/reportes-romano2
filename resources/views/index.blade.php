@extends('app')
@section('title', 'El Romano')

@section('content')
<section class="cuerpo-principal">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <!-- <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol> -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                @foreach ($datos as $dato)
                <img src="{{$dato->imagen_fondo}}" class="d-block w-100 imagen-principal" alt="imagen principal">
                <div class="carousel-caption d-none d-md-block texto-imagen">
                    <h1><strong>{{$dato->nombre}}</strong></h1>
                    <p>{{$dato->eslogan}}</p>
                </div>
                @endforeach
            </div>
            <!-- <div class="carousel-item">
                <img src="https://www.logicadigital.com.br/arquivos/2019/01/shutterstock_1107359975.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://vidabytes.com/wp-content/uploads/2020/06/tipos-de-internet-1.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div> -->
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button> -->
    </div>
    <div class="sobre-nosotros">
        <div class="container">
            <h5 class="text-center titulo-seccion"><strong>SOBRE NOSOTROS</strong></h5>
            @foreach ($datos as $dato)
            <p class="text-center mt-4">{{$dato->sobre_nosotros}}</p>
            @endforeach
        </div>
    </div>

    <div class=" paquetes">
        <h5 class="text-center titulo-seccion"><strong>PAQUETES DE INTERNET</strong></h5>

        <div class="swiper mySwiper container">
            <div class="swiper-wrapper">
                @foreach ($paquetes as $paquete)
                <div class="swiper-slide">
                    <div class="tarjeta-paquete">
                        <div class="container">
                            <h2 class="pt-4"><strong>{{$paquete->velocidad}}</strong></h2>
                            <p>de velocidad</p>
                            <br>
                            <h4><strong>${{$paquete->costo}} MXN</strong></h4>
                            <p>{{$paquete->periodo}}</p>
                            <br>
                            <p class="parrafo-tarjeta"><small>{{$paquete->descripcion}}</small></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="contacto">
        <div class="container">
            <h5 class="text-center titulo-seccion"><strong>CONTÁCTANOS</strong></h5>
            <div class="row">
                @foreach ($datos as $dato)
                <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                    <div>
                        <label for="recipient-name" class="col-form-label"><strong><i class="fa-solid fa-location-dot fa-lg mr-2"></i></strong>{{$dato->direccion}} <br> {{$dato->ciudad}} </label>
                    </div>
                    <div>
                        <label for="recipient-name" class="col-form-label"><strong><i class="fa-solid fa-phone fa-lg mr-2"></i></strong>{{$dato->telefono}}</label>
                    </div>
                </div>
                <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="iconos-redes-sociales">
                        @if($dato->facebook != null)
                        <a href="{{$dato->facebook}}" target="_blank"><strong><i class="fa-brands fa-facebook fa-lg"></i></strong></a>
                        @endif
                        @if ($dato->whatsapp != null)
                        <a href="https://wa.me/{{$dato->whatsapp}}?text=Hola,%20revisé%20su%20página%20web%20y%20quiero%20información%20de%20sus%20servicios." target="_blank"><strong><i class="fa-brands fa-whatsapp fa-lg"></i></strong></a>
                        @endif
                        @if ($dato->correo != null)
                        <a href="mailto:{{$dato->correo}}" target="_blank"><strong><i class="fa-regular fa-envelope fa-lg"></i></strong></a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection