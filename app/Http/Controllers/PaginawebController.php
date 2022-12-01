<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PaginawebController extends Controller
{
    //
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
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
                    $response1 = $this->client->request('GET', 'datos-empresa', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . config('app.app_id_key'),
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $datos = json_decode($response1->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'paquetes-internet', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . config('app.app_id_key'),
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $paquetes = json_decode($response2->getBody()->getContents());

                    return view('/administrador/administrar-pagina-web', compact('datos', 'paquetes'));
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

    public function storePaquete(Request $request)
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
                    request()->validate([
                        'velocidad' => ['required', 'max:10'],
                        'costo' => ['required', 'numeric'],
                        'periodo' => ['required', 'max:20'],
                        'descripcion' => 'nullable'
                    ]);

                    $this->client->request('POST', 'paquetes-internet', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'velocidad' => $request->velocidad,
                            'costo' => $request->costo,
                            'periodo' => $request->periodo,
                            'descripcion' => $request->descripcion
                        ]
                    ]);

                    return redirect('/administrar-pagina-web')->with('message', 'Se ha registrado el paquete correctamente.');
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

    public function updatePaquete(Request $request)
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
                    request()->validate([
                        'id' => ['required', 'numeric', 'integer'],
                        'velocidad' => ['required', 'max:10'],
                        'costo' => ['required', 'numeric'],
                        'periodo' => ['required', 'max:20'],
                        'descripcion' => 'nullable'
                    ]);

                    $this->client->request('PUT', 'actualizar-paquete/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'velocidad' => $request->velocidad,
                            'costo' => $request->costo,
                            'periodo' => $request->periodo,
                            'descripcion' => $request->descripcion
                        ]
                    ]);

                    return redirect('/administrar-pagina-web')->with('message', 'Se ha modificado el paquete ' . $request->id . ' correctamente.');
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

    public function updateCabecera(Request $request)
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
                    request()->validate([
                        'id' => ['required', 'numeric', 'integer'],
                        'nombre' => ['required', 'max:50'],
                        'eslogan' => ['required', 'max:80']
                    ]);

                    $ruta_imagen = "";
                    
                    if ($request->hasFile('imagen_fondo')) {
                        request()->validate([
                            'imagen_fondo' => ['image', 'max:1000']
                        ]);

                        $img = $request->file('imagen_fondo');
                        $carpeta = 'img/empresa/';
                        $nombre_imagen = time() . '_' . $img->getClientOriginalName();

                        $ruta_imagen = $carpeta . $nombre_imagen;
                        $request->file('imagen_fondo')->move($carpeta, $nombre_imagen); //Guarda la foto nueva

                        File::delete($request->foto_actual); //Elimina la foto antigua
                    }
                    dd($ruta_imagen);
                    $this->client->request('PUT', 'actualizar-datos-cabecera/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'nombre' => $request->nombre,
                            'eslogan' => $request->eslogan,
                            'imagen_fondo' => $ruta_imagen
                        ]
                    ]);

                    return redirect('/administrar-pagina-web')->with('message', 'Se ha modificado el contenido correctamente.');
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
                    dd($e);
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function updateNosotros(Request $request)
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
                    request()->validate([
                        'id' => ['required', 'numeric', 'integer'],
                        'sobre_nosotros' => ['required']
                    ]);

                    $this->client->request('PUT', 'actualizar-datos-nosotros/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'sobre_nosotros' => $request->sobre_nosotros
                        ]
                    ]);

                    return redirect('/administrar-pagina-web')->with('message', 'Se ha modificado el contenido correctamente.');
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

    public function updateContacto(Request $request)
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
                    request()->validate([
                        'id' => ['required', 'numeric', 'integer'],
                        'direccion' => ['required', 'max:100'],
                        'ciudad' => ['required', 'max:100'],
                        'telefono' => ['required', 'max:20']
                    ]);

                    $email = trim($request->correo);
                    if ($email != null && strlen($email) > 0) {
                        request()->validate([
                            'correo' => ['email:rfc,dns', 'max:100']
                        ]);
                    }

                    $fb = trim($request->facebook);
                    if ($fb != null && strlen($fb) > 0) {
                        request()->validate([
                            'facebook' => ['max:200']
                        ]);
                    }

                    $wa = trim($request->whatsapp);
                    if ($wa != null && strlen($wa) > 0) {
                        request()->validate([
                            'whatsapp' => ['max:50']
                        ]);
                    }

                    $this->client->request('PUT', 'actualizar-datos-contacto/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'direccion' => $request->direccion,
                            'ciudad' => $request->ciudad,
                            'telefono' => $request->telefono,
                            'correo' => $request->correo,
                            'facebook' => $request->facebook,
                            'whatsapp' => $request->whatsapp
                        ]
                    ]);

                    return redirect('/administrar-pagina-web')->with('message', 'Se ha modificado el contenido de contácto correctamente.');
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
}
