<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;

class ReporteController extends Controller
{
    //
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $response = $this->client->request('GET', 'clientes', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $clientes = json_decode($response->getBody()->getContents());

                    return view('/reportes/levantar-reportes', compact('clientes'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    request()->validate([
                        'fk_servicio' => ['required', 'numeric', 'integer'],
                        'problema' => ['required']
                    ]);

                    $vecesReportado = 1;
                    $reporto = auth()->user()->fk_clave_persona;
                    $fechaReporte = now()->isoFormat('YYYY-MM-DD');
                    $horaReporte = now()->isoFormat('H:mm:ss');
                    $estatus = 1;

                    $this->client->request('POST', 'levantar-reporte', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'fk_servicio' => $request->fk_servicio,
                            'problema' => $request->problema,
                            'veces_reportado' => $vecesReportado,
                            'reporto' => $reporto,
                            'fecha_reporte' => $fechaReporte,
                            'hora_reporte' => $horaReporte,
                            'estatus' => $estatus
                        ]
                    ]);

                    return redirect('/levantar-reportes')->with('message', 'Se ha registrado el reporte correctamente.');
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function indexHistorial()
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $fechaActual = now()->isoFormat('YYYY-MM-DD');

                    $response = $this->client->request('GET', 'historial-reportes/' . $fechaActual . '/estatus/n', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $reportes = json_decode($response->getBody()->getContents());

                    return view('/reportes/historial-reportes', compact('reportes'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function misReportes()
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $usuario = auth()->user()->fk_clave_persona;

                    $response = $this->client->request('GET', 'mis-reportes/' . $usuario, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $misReportes = json_decode($response->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'comunidades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $comunidades = json_decode($response2->getBody()->getContents());

                    return view('/tecnicos/mis-reportes', compact('misReportes', 'comunidades'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function indexPendientes()
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $response = $this->client->request('GET', 'reportes-pendientes', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $pendientes = json_decode($response->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'ciudades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $ciudades = json_decode($response2->getBody()->getContents());

                    return view('/tecnicos/reportes-pendientes', compact('pendientes', 'ciudades'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function indexHistorialFilter(Request $request)
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $fechaFiltro = "";
                    if ($request->fecha_filtro == null) {
                        $fechaFiltro = now()->isoFormat('YYYY-MM-DD');
                    } else {
                        $fechaFiltro = $request->fecha_filtro;
                    }

                    $Estatus = "";
                    if ($request->estatus == null) {
                        $Estatus = "n";
                    } else {
                        $Estatus = $request->estatus;
                    }

                    $response = $this->client->request('GET', 'historial-reportes/' . $fechaFiltro . '/' . 'estatus/' . $Estatus, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $reportes = json_decode($response->getBody()->getContents());

                    session()->flashInput($request->input());
                    return view('/reportes/historial-reportes', compact('reportes'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function indexPendientesFilter(Request $request)
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    request()->validate([
                        'ciudad' => ['required', 'numeric', 'integer'],
                        'comunidad' => ['required', 'numeric', 'integer']
                    ]);

                    $response = $this->client->request('GET', 'reportes-pendientes/' . $request->ciudad . '/' . 'comunidad/' . $request->comunidad, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $pendientes = json_decode($response->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'ciudades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $ciudades = json_decode($response2->getBody()->getContents());

                    session()->flashInput($request->input());
                    return view('/tecnicos/reportes-pendientes', compact('pendientes', 'ciudades'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function misReportesFilter(Request $request)
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $usuario = auth()->user()->fk_clave_persona;
                    request()->validate([
                        'comunidad' => ['required', 'numeric', 'integer']
                    ]);

                    $estatus = 'n';
                    $fechaFiltro = now()->isoFormat('YYYY-MM-DD');
                    if (trim($request->estatus) != null) {
                        $estatus = $request->estatus;
                    }

                    if (trim($request->fechaFiltro) != null) {
                        $fechaFiltro = $request->fechaFiltro;
                    }

                    $response = $this->client->request('GET', 'mis-reportes/' . $usuario . '/estatus' . '/' . $estatus . '/comunidad' . '/' . $request->comunidad . '/fecha' . '/' . $fechaFiltro, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $misReportes = json_decode($response->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'comunidades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $comunidades = json_decode($response2->getBody()->getContents());

                    session()->flashInput($request->input());
                    return view('/tecnicos/mis-reportes', compact('misReportes', 'comunidades'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function updateProblema(Request $request)
    {
        //
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    request()->validate([
                        'clave_reporte' => ['required', 'numeric', 'integer'],
                        'problema' => ['required']
                    ]);

                    $this->client->request('PUT', 'historial-reportes-editar/' . $request->clave_reporte, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'problema' => $request->problema
                        ]
                    ]);

                    return redirect('/historial-reportes')->with('message', 'Se ha modificado el reporte ' . $request->clave_reporte . ' correctamente.');
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function updateVeces(Request $request)
    {
        //
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    request()->validate([
                        'clave_reporte' => ['required', 'numeric', 'integer']
                    ]);

                    $this->client->request('PUT', 'historial-reportes-aumentar/' . $request->clave_reporte, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);

                    return redirect('/historial-reportes')->with('message', 'Se ha aumentado las veces reportado para el reporte ' . $request->clave_reporte . ' correctamente.');
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function updateTecnico($clave_reporte)
    {
        //
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $tecnico = auth()->user()->fk_clave_persona;

                    $this->client->request('PUT', 'detalle-reportes-editar/' . $clave_reporte, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'fk_tecnico' => $tecnico
                        ]
                    ]);
                    return redirect('/detalle-reporte' . '/' . $clave_reporte);
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                $exception = json_decode($e->getResponse()->getBody()->getContents());

                if (json_decode($e->getResponse()->getBody()->getContents())) {
                    return redirect()->back()->withErrors($exception->error);
                } else if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function showDetalle($claveReporte)
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $tecnico = auth()->user()->fk_clave_persona;

                    $response = $this->client->request('GET', 'detalle-reportes/' . $claveReporte . '/' . 'tecnico/' . $tecnico, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $detalles = json_decode($response->getBody()->getContents());

                    return view('/tecnicos/detalle-reporte', compact('detalles'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                $exception = json_decode($e->getResponse()->getBody()->getContents());

                if (json_decode($e->getResponse()->getBody()->getContents())) {
                    return redirect('/reportes-pendientes')->withErrors($exception->error);
                } else if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function showEstadisticas()
    {
        if (auth()->user()->fk_rol == 1) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $ciudad = 1;
                    $fechaInicio = now()->isoFormat('YYYY-MM-DD');
                    $fechaFin = now()->isoFormat('YYYY-MM-DD');

                    $response = $this->client->request('GET', 'estadisticas-comunidad/' . $ciudad . '/' . 'fecha-inicio/' . $fechaInicio . '/' . 'fecha-fin/' . $fechaFin, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $comunidad = json_decode($response->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'estadisticas-estatus/' . $ciudad . '/' . 'fecha-inicio/' . $fechaInicio . '/' . 'fecha-fin/' . $fechaFin, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $estatus = json_decode($response2->getBody()->getContents());

                    $response3 = $this->client->request('GET', 'ciudades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $ciudades = json_decode($response3->getBody()->getContents());

                    $arrayComunidades = array();
                    $arrayValores = array();

                    for ($i = 0; $i < count($comunidad); $i++) {
                        $arrayComunidades[$i] = $comunidad[$i]->comunidad;
                        $arrayValores[$i] = $comunidad[$i]->total;
                    }

                    $arrayEstatus = array();
                    $arrayPorcentaje = array();

                    for ($i = 0; $i < count($estatus); $i++) {
                        $arrayEstatus[$i] = $estatus[$i]->estatus;
                        $arrayPorcentaje[$i] = $estatus[$i]->total;
                    }

                    return view('/administrador/estadisticas', compact('arrayComunidades', 'arrayValores', 'arrayEstatus', 'arrayPorcentaje', 'ciudades'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function showEstadisticasFilter(Request $request)
    {
        if (auth()->user()->fk_rol == 1) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $ciudad = 1;
                    $fechaInicio = now()->isoFormat('YYYY-MM-DD');
                    $fechaFin = now()->isoFormat('YYYY-MM-DD');

                    if ($request->municipio != null) {
                        $ciudad = $request->municipio;
                    }

                    if ($request->fechaInicio != null) {
                        $fechaInicio = $request->fechaInicio;
                    }

                    if ($request->fechaFin != null) {
                        $fechaFin = $request->fechaFin;
                    }

                    $response = $this->client->request('GET', 'estadisticas-comunidad/' . $ciudad . '/' . 'fecha-inicio/' . $fechaInicio . '/' . 'fecha-fin/' . $fechaFin, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $comunidad = json_decode($response->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'estadisticas-estatus/' . $ciudad . '/' . 'fecha-inicio/' . $fechaInicio . '/' . 'fecha-fin/' . $fechaFin, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $estatus = json_decode($response2->getBody()->getContents());

                    $response3 = $this->client->request('GET', 'ciudades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $ciudades = json_decode($response3->getBody()->getContents());

                    $arrayComunidades = array();
                    $arrayValores = array();

                    for ($i = 0; $i < count($comunidad); $i++) {
                        $arrayComunidades[$i] = $comunidad[$i]->comunidad;
                        $arrayValores[$i] = $comunidad[$i]->total;
                    }

                    $arrayEstatus = array();
                    $arrayPorcentaje = array();

                    for ($i = 0; $i < count($estatus); $i++) {
                        $arrayEstatus[$i] = $estatus[$i]->estatus;
                        $arrayPorcentaje[$i] = $estatus[$i]->total;
                    }

                    session()->flashInput($request->input());
                    return view('/administrador/estadisticas', compact('arrayComunidades', 'arrayValores', 'arrayEstatus', 'arrayPorcentaje', 'ciudades'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function finalizarReporte($claveReporte, Request $request)
    {
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $tecnico = auth()->user()->fk_clave_persona;
                    $fechaFinalizacion = now()->isoFormat('YYYY-MM-DD');
                    $horaFinalizacion = now()->isoFormat('H:mm:ss');

                    request()->validate([
                        'observaciones' => ['required']
                    ]);

                    $this->client->request('PUT', 'finalizar-reporte/' . $claveReporte, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'clave_tecnico' => $tecnico,
                            'observaciones' => $request->observaciones,
                            'fecha_finalizacion' => $fechaFinalizacion,
                            'hora_finalizacion' => $horaFinalizacion
                        ]
                    ]);

                    return redirect('/reportes-pendientes')->with('message', 'Se ha finalizado el reporte correctamente.');
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                $exception = json_decode($e->getResponse()->getBody()->getContents());

                if (json_decode($e->getResponse()->getBody()->getContents())) {
                    return redirect('/detalle-reporte' . '/' . $claveReporte)->withErrors($exception->error);
                } else if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }
}
