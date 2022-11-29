@extends('app')
@section('title', 'Detalle reporte')

@section('content')

<section class="cuerpo mb-4">
    <div class="container">

        @foreach ($detalles as $detalle)
        <div class="row tarjeta buscador">
            <div class="container text-center pt-2">
                <h5 class="text-center"><strong>Detalle del Reporte {{$detalle->clave_reporte}}</strong></h5>
            </div>
            <div class="separador"></div>
            <div class="col-12 col-lg-5 col-md-5 col-sm-12 pb-2">
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Cliente:</strong> {{$detalle->cliente}}</label>
                </div>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong> {{$detalle->ciudad}}</label>
                </div>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Comunidad:</strong> {{$detalle->comunidad}}</label>
                </div>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Dirección:</strong> {{$detalle->direccion}} #{{$detalle->nexterior}}</label>
                </div>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Teléfono:</strong> {{$detalle->telefono_movil}}</label>
                </div>
                <br>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Fecha y hora del reporte:</strong> {{$detalle->fecha_reporte}} {{$detalle->hora_reporte}}</label>
                </div>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Registró:</strong> {{$detalle->reporto}}</label>
                </div>
                <br>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Problema:</strong> {{$detalle->problema}}</label>
                </div>
                <div>
                    <label for="recipient-name" class="col-form-label"><strong>Veces reportado:</strong> {{$detalle->veces_reportado}}</label>
                </div>
            </div>

            <div class="col-12 col-lg-7 col-md-7 col-sm-12 mb-3">
                <label for="recipient-name" class="col-form-label"><strong><i class="fa-solid fa-location-dot mr-2"></i>Ubicación del cliente</strong></label>

                @if ($detalle->latitud != null && $detalle->longitud != null)
                <div id='map' style='width: 100%; height: 480px;'></div>
                <div id="geocoder" class="geocoder"></div>
                <script>
                    var longitud = JSON.parse('{!! json_encode($detalle->longitud) !!}');
                    var latitud = JSON.parse('{!! json_encode($detalle->latitud) !!}');

                    const bounds = [
                        [-102.931503, 20.559788], // Southwest coordinates
                        [-100.708892, 22.954650] // Northeast coordinates
                    ];

                    mapboxgl.accessToken = 'pk.eyJ1IjoiZGFuaWVsZWQiLCJhIjoiY2xhcjNyMzYyMDAwODNvbjRjdG14cW1hMSJ9.xJhJsf0yTUZ7qEXpww0N1w';
                    const map = new mapboxgl.Map({
                        container: 'map', // container ID
                        style: 'mapbox://styles/mapbox/streets-v12', // style URL
                        center: [longitud, latitud], // starting position [lng, lat]
                        zoom: 11, // starting zoom
                        maxBounds: bounds // Set the map's geographical boundaries.
                    });

                    const geojson = {
                        type: 'FeatureCollection',
                        features: [{
                            type: 'Feature',
                            geometry: {
                                type: 'Point',
                                coordinates: [longitud, latitud]
                            },
                            properties: {
                                title: 'Destino',
                                description: 'Domicilio del cliente.'
                            }
                        }]
                    };

                    for (const feature of geojson.features) {
                        // create a HTML element for each feature
                        const el = document.createElement('div');
                        el.className = 'marker';

                        // make a marker for each feature and add to the map
                        new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).setPopup(
                            new mapboxgl.Popup({
                                offset: 25
                            }) // add popups
                            .setHTML(
                                `<h5>${feature.properties.title}</h5><p>${feature.properties.description}</p>`
                            )
                        ).addTo(map);
                    }

                    // Add geolocate control to the map.
                    map.addControl(
                        new mapboxgl.GeolocateControl({
                            positionOptions: {
                                enableHighAccuracy: true
                            },
                            // When active the map will receive updates to the device's location as it changes.
                            trackUserLocation: true,
                            // Draw an arrow next to the location dot to indicate which direction the device is heading.
                            showUserHeading: true
                        }),
                        'bottom-right'
                    );

                    map.addControl(
                        new MapboxDirections({
                            accessToken: mapboxgl.accessToken,
                            unit: 'metric',
                            profile: 'mapbox/driving',
                            language: 'es-MX',
                            steps: true,
                            geocoder: {
                                language: 'es'
                            }
                        }),
                        'top-left'
                    );

                    map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');
                    map.addControl(new mapboxgl.FullscreenControl(), 'bottom-left');

                    map.on('load', function() {
                        let labels = ['country-label', 'state-label', 'settlement-subdivision-label',
                            'airport-label', 'poi-label', 'water-point-label',
                            'water-line-label', 'natural-point-label',
                            'natural-line-label', 'waterway-label', 'road-label'
                        ];

                        labels.forEach(label => {
                            map.setLayoutProperty(label, 'text-field', ['get', 'name_es']);
                        });
                    });
                </script>
                @else
                <div class="container mx-auto mt-4">
                    <p align="justify" class="empty-message"><i class="fa-solid fa-circle-exclamation mr-2"></i>No hay datos de ubicación disponibles para este cliente.</p>
                </div>
                @endif
            </div>

            <div class="container modal-footer separar-botones">
                @if ($detalle->foto_fachada != null)
                <button type="button" data-dismiss="modal" class="btn btn-reportar" data-toggle="modal" data-target="#view-facade-modal">
                    <strong>Ver fachada</strong>
                </button>
                @endif
                <button type="button" data-dismiss="modal" class="btn btn-finalizar" data-toggle="modal" data-target="#end-report-modal">
                    <strong>Finalizar reporte</strong>
                </button>
            </div>
        </div>
        @include('/modals/ver-foto-fachada')
        @include('/modals/finalizar-reporte')
        @endforeach
    </div>
</section>

@endsection