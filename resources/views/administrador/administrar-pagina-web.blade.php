@extends('app')
@section('title', 'Administrar página web')

@section('content')
<section class="cuerpo mb-4">
    <div class="container pb-4">
        <h5 class="text-center"><strong>ADMINISTRAR PÁGINA WEB</strong></h5>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 col-md-3 col-sm-12 pb-2">
                <div class="tarjeta-clientes">
                    <div class="container">
                        <h5 class="text-center pt-2"><strong>SECCIONES</strong></h5>
                    </div>
                    <div class="separador"></div>
                    <div class="container" id="botones-secciones">
                        <div class="boton-pie">
                            <button class="btn btn-contenido" id="btn-cabecera"><strong id="str-cabecera">Cabecera</strong></button>
                        </div>
                        <div class="boton-pie">
                            <button class="btn btn-contenido" id="btn-sobre-nosotros"><strong id="str-sobre-nosotros">Sobre nosotros</strong></button>
                        </div>
                        <div class="boton-pie">
                            <button class="btn btn-contenido" id="btn-paquetes"><strong id="str-paquetes">Paquetes de internet</strong></button>
                        </div>
                        <div class="boton-pie">
                            <button class="btn btn-contenido" id="btn-contacto"><strong id="str-contacto">Contácto</strong></button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-9 col-md-9 col-sm-12 pb-2">
                <!-- CABECERA -->
                <div id="cabecera" hidden>
                    <div class="container">
                        <h5 class="text-center pt-2"><strong>CABECERA</strong></h5>
                    </div>
                    <div class="separador"></div>
                    <div class="tabla">
                        <table class="table table-hover table-striped display responsive nowrap" id="tabla-administrar-contenido" style="width:100%">
                            <thead class="thead-style">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Eslogan</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach ($datos as $dato)
                                <tr>
                                    <td>
                                        @if($dato->imagen_fondo != null)
                                        <img class="img-tabla" src="{!! asset('{{$dato->imagen_fondo}}') !!}" alt="imagen actual de la cabecera">
                                        @else
                                        No hay imagen disponible.
                                        @endif
                                    </td>
                                    <td>{{$dato->nombre}}</td>
                                    <td>{{$dato->eslogan}}</td>
                                    <td class="action-buttons">
                                        <button class="btn btn-reportar mr-3" title="Editar" data-toggle="modal" data-target="#admin-edit-cabecera" data-img="{{$dato->imagen_fondo}}" data-esl="{{$dato->eslogan}}" data-nom="{{$dato->nombre}}" data-id="{{$dato->clave_empresa}}">
                                            <strong>Editar</strong>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- SOBRE NOSOTROS -->
                <div id="sobre-nosotros" hidden>
                    <div class="container">
                        <h5 class="text-center pt-2"><strong>SOBRE NOSOTROS</strong></h5>
                    </div>
                    <div class="separador"></div>
                    <div class="tabla">
                        <table class="table table-hover table-striped display responsive" id="tabla-sobre-nosotros" style="width:100%">
                            <thead class="thead-style">
                                <tr>
                                    <th>Texto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach ($datos as $dato)
                                <tr>
                                    <td>{{$dato->sobre_nosotros}}</td>
                                    <td class="action-buttons">
                                        <button class="btn btn-reportar mr-3" title="Editar" data-toggle="modal" data-target="#admin-edit-sobre-nosotros" data-nos="{{$dato->sobre_nosotros}}" data-id="{{$dato->clave_empresa}}">
                                            <strong>Editar</strong>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PAQUETES DE INTERNET -->
                <div id="paquetes" hidden>
                    <div class="container">
                        <h5 class="text-center pt-2"><strong>PAQUETES DE INTERNET</strong></h5>
                        <div class="btn-derecha">
                            <button class="btn btn-contenido" data-toggle="modal" data-target="#admin-add-paquetes"><strong>Nuevo paquete</strong></button>
                        </div>
                    </div>
                    <div class="separador"></div>
                    <div class="tabla">
                        <table class="table table-hover table-striped display responsive " id="tabla-lista-paquetes" style="width:100%">
                            <thead class="thead-style">
                                <tr>
                                    <th>Clave paquete</th>
                                    <th>Velocidad</th>
                                    <th>Costo</th>
                                    <th>Periodo</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach ($paquetes as $paquete)
                                <tr>
                                    <td>{{$paquete->clave_paquete}}</td>
                                    <td>{{$paquete->velocidad}}</td>
                                    <td>{{$paquete->costo}}</td>
                                    <td>{{$paquete->periodo}}</td>
                                    <td>{{$paquete->descripcion}}</td>
                                    <td class="action-buttons">
                                        <button class="btn btn-reportar mr-3" title="Editar" data-toggle="modal" data-target="#admin-edit-paquetes" data-id="{{$paquete->clave_paquete}}" data-vel="{{$paquete->velocidad}}" data-cos="{{$paquete->costo}}" data-per="{{$paquete->periodo}}" data-des="{{$paquete->descripcion}}"><strong>Editar</strong></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- CONTACTO -->
                <div id="contacto" hidden>
                    <div class="container">
                        <h5 class="text-center pt-2"><strong>CONTÁCTANOS</strong></h5>
                    </div>
                    <div class="separador"></div>
                    <div class="tabla">
                        <table class="table table-hover table-striped display responsive " id="tabla-contacto" style="width:100%">
                            <thead class="thead-style">
                                <tr>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th class="none">Facebook</th>
                                    <th class="none">Whatsapp</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach ($datos as $dato)
                                <tr>
                                    <td>{{$dato->direccion}}</td>
                                    <td>{{$dato->ciudad}}</td>
                                    <td>{{$dato->telefono}}</td>
                                    <td>{{$dato->correo}}</td>
                                    <td>{{$dato->facebook}}</td>
                                    <td>{{$dato->whatsapp}}</td>
                                    <td class="action-buttons">
                                        <button class="btn btn-reportar mr-3" title="Editar" data-toggle="modal" data-wht="{{$dato->whatsapp}}" data-face="{{$dato->facebook}}" data-mail="{{$dato->correo}}" data-tel="{{$dato->telefono}}" data-city="{{$dato->ciudad}}" data-dir="{{$dato->direccion}}" data-id="{{$dato->clave_empresa}}" data-target="#admin-edit-contacto"><strong>Editar</strong></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR EL CONTENIDO DE LA CABECERA -->
    <div class="modal fade" id="admin-edit-cabecera" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-pagina-web-cabecera/editar" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="id" id="input-id" class="form-control" hidden required>
                        </div>
                        <div>
                            <input type="text" name="foto_actual" id="input-foto" class="form-control" hidden>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1"><strong>Imagen</strong></label>
                            <input type="file" class="form-control-file" name="imagen_fondo" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"><strong>Nombre:</strong></label>
                            <input type="text" name="nombre" id="input-nombre" class="form-control" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Eslogan:</strong> </label>
                            <textarea rows="3" class="form-control" id="input-eslogan" name="eslogan" maxlength="80" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR EL CONTENIDO DE SOBRE NOSOTROS -->
    <div class="modal fade" id="admin-edit-sobre-nosotros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-pagina-web-nosotros/editar" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="id" id="input-id" class="form-control" hidden required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Texto:</strong> </label>
                            <textarea rows="3" class="form-control" name="sobre_nosotros" id="txt-nosotros" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR EL CONTENIDO DE PAQUETES DE INTERNET -->
    <div class="modal fade" id="admin-edit-paquetes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/administrar-pagina-web-paquete/editar" method="POST">
                        @csrf
                        <div>
                            <input type="text" name="id" id="input-id" class="form-control" hidden>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Velocidad:</strong></label>
                            <input type="text" name="velocidad" id="input-velocidad" maxlength="10" class="form-control" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Costo:</strong></label>
                            <input type="text" name="costo" id="input-costo" pattern="[0-9]+.[0-9]+" title="Solo se permiten números enteros o decimales." class="form-control" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Periodo:</strong></label>
                            <input type="text" name="periodo" id="input-periodo" maxlength="20" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Descripción:</strong> </label>
                            <textarea rows="4" class="form-control" id="textarea-descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR EL CONTENIDO DE CONTACTO -->
    <div class="modal fade" id="admin-edit-contacto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-pagina-web-contacto/editar" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="id" id="input-id" class="form-control" hidden>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"><strong>Dirección:</strong></label>
                            <input type="text" name="direccion" id="input-direccion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong></label>
                            <input type="text" name="ciudad" id="input-ciudad" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Teléfono:</strong> </label>
                            <input type="text" class="form-control" name="telefono" id="input-telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Correo:</strong> </label>
                            <input type="email" class="form-control" name="correo" id="input-correo">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Facebook:</strong> </label>
                            <input type="text" class="form-control" name="facebook" id="input-facebook">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Whatsapp:</strong> </label>
                            <input type="text" class="form-control" name="whatsapp" id="input-whatsapp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR PAQUETES DE INTERNET -->
    <div class="modal fade" id="admin-add-paquetes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Registrar paquete</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/administrar-pagina-web-paquete" method="POST">
                        @csrf
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Velocidad:</strong></label>
                            <input type="text" name="velocidad" class="form-control" maxlength="10" required>
                        </div>

                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Costo:</strong></label>
                            <input type="text" name="costo" class="form-control" pattern="[0-9]+.[0-9]+" title="Solo se permiten números enteros o decimales." required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Periodo:</strong></label>
                            <input type="text" name="periodo" class="form-control" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label"><strong>Descripción:</strong> </label>
                            <textarea rows="4" class="form-control" name="descripcion"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-reportar"><strong>Registrar</strong></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection