<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    //
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function show()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            $response = $this->client->request('GET', 'validar-admin', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('app.app_id_key'),
                    'Accept' => 'application/json',
                ],
            ]);
            $existe = json_decode($response->getBody()->getContents());

            if (!$existe) {
                $this->client->request('POST', 'roles', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'clave_rol' => 1,
                        'rol' => 'Administrador'
                    ]
                ]);

                $this->client->request('POST', 'roles', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'clave_rol' => 2,
                        'rol' => 'Atención al cliente'
                    ]
                ]);

                $this->client->request('POST', 'roles', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'clave_rol' => 3,
                        'rol' => 'Técnico'
                    ]
                ]);

                $this->client->request('POST', 'roles', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'clave_rol' => 4,
                        'rol' => 'Cliente'
                    ]
                ]);

                $this->client->request('POST', 'ciudades', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'ciudad' => 'Lagos de Moreno'
                    ]
                ]);

                $this->client->request('POST', 'usuarios', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'nombre' => 'Administrador',
                        'fk_ciudad' => 1,
                        'telefono_movil' => '123456789',
                        'usuario' => 'adminGenerico',
                        'fk_rol' => 1,
                        'estatus' => 1,
                        'email' => 'admin@correo.com',
                        'password' => bcrypt('123456789')
                    ]
                ]);

                $this->client->request('POST', 'datos-empresa', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'nombre' => 'El Romano',
                        'logo' => 'logo.png',
                        'imagen_fondo' => 'imagen.jpg',
                        'sobre_nosotros' => 'Sobre nosotros...',
                        'direccion' => 'Dirección',
                        'ciudad' => 'Ciudad',
                        'telefono' => 'Telefono'
                    ]
                ]);
            }
            return view('auth.login');
        }
    }

    //LoginRequest $request
    public function iniciarSesion(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            request()->validate([
                'usuario' => ['required'],
                'password' => ['required']
            ]);

            try {
                $response = $this->client->request('POST', 'auth/login', [
                    'form_params' => [
                        'usuario' => $request->usuario,
                        'password' => $request->password
                    ]
                ]);

                $login = json_decode($response->getBody()->getContents());

                //dd($request->input());
                if ($this->isEmail($request->input())) {
                    $credentials = ['email' => $request->usuario, 'password' => $request->password];
                } else {
                    $credentials = ['usuario' => $request->usuario, 'password' => $request->password];
                }

                $user = Auth::getProvider()->retrieveByCredentials($credentials);

                $response = $this->client->request('GET', 'validar-estatus/' . $user->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $login->access_token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $estatus = json_decode($response->getBody()->getContents());

                if ($user->fk_rol != 4 && $estatus[0]->estatus == 0) {
                    return redirect('/login')->withErrors('Acceso denegado. Usuario inactivo, contacte con el Administrador.');
                } else {
                    Auth::login($user);
                    session(['token' => $login->access_token]);

                    return $this->authenticated($user);
                }
            } catch (RequestException $e) {
                $exception = json_decode($e->getResponse()->getBody()->getContents());
                if ($exception) {
                    return redirect('/login')->withErrors($exception->error);
                } else {
                    abort($e->getCode());
                }
            }
        }
    }

    public function isEmail($value)
    {
        $validator = Validator::make($value, [
            'usuario' => ['email:rfc,dns']
        ]);

        if ($validator->fails()) {
            return false;
        } else {
            return true;
        }
    }

    public function authenticated($user)
    {
        if ($user->fk_rol == 1) {
            return redirect('/administrar-pagina-web');
        }
        if ($user->fk_rol == 2) {
            return redirect('/levantar-reportes');
        }
        if ($user->fk_rol == 3) {
            return redirect('/reportes-pendientes');
        }
        if ($user->fk_rol == 4) {
            return redirect('/mi-cuenta');
        }
    }
}
