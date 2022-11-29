<?php
$fechaActual = date("Y-m-d");
?>

@extends('app')
@section('title', 'Estadísticas')

@section('content')
<section class="cuerpo mb-4">
    <div class="container">
        <div class="filter_options">
            <form action="/estadisticas" method="post">
                @csrf
                <div class="row">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                            <label for="">Municipio</label>
                            <select class="form-control buscador" name="municipio">
                                @foreach ($ciudades as $ciudad)
                                <option {{ old('municipio') == $ciudad->clave_ciudad ? "selected" : "" }} value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                            <label for="">Fecha inicio</label>
                            <input class="form-control buscador" type="date" name="fechaInicio" value="{{Request::old('fechaInicio')}}" max="<?php echo $fechaActual; ?>">
                        </div>
                        <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                            <label for="">Fecha fin</label>
                            <input class="form-control buscador" type="date" name="fechaFin" value="{{Request::old('fechaFin')}}" max="<?php echo $fechaActual; ?>">
                        </div>
                        <div class="col-12 col-lg-1 col-md-1 col-sm-12"></div>
                        <div class="form-group col-12 col-lg-2 col-md-2 col-sm-12">
                            <br>
                            <button type="submit" class="btn btn-contenido boton-full mt-2 mr-3"><i class="fa-solid fa-magnifying-glass mr-3"></i>Filtrar</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>

    <div class="container pt-4">
        <div class="row">
            <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                <label for="">TOTAL POR COMUNIDAD</label>
                <canvas id="grafica-comunidad" width="400" height="400"></canvas>
                <script>
                    var comunidades= JSON.parse('{!! json_encode($arrayComunidades) !!}');
                    var valores= JSON.parse('{!! json_encode($arrayValores) !!}');

                    const gc = document.getElementById('grafica-comunidad').getContext('2d');
                    const graficaComunidad = new Chart(gc, {
                        type: 'bar',
                        data: {
                            labels: comunidades,
                            datasets: [{
                                label: 'Cantidad de reportes',
                                data: valores,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12"></div>
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <label for="">ESTATUS DE REPORTES</label>
                <canvas id="grafica-estatus" width="400" height="400"></canvas>
                <script>
                    var estatus = JSON.parse('{!! json_encode($arrayEstatus) !!}');
                    var porcentajes = JSON.parse('{!! json_encode($arrayPorcentaje) !!}');

                    const ge = document.getElementById('grafica-estatus').getContext('2d');
                    const graficaEstatus = new Chart(ge, {
                        type: 'pie',
                        data: {
                            labels: estatus,
                            datasets: [{
                                label: '# of Votes',
                                data: porcentajes,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 4
                            }]
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</section>
@endsection