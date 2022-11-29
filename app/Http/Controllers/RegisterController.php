<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\RequestException;

class RegisterController extends Controller
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
            return view('auth.registrarme');
        }
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            try {
                $response = $this->client->request('POST', 'auth/usuarios-clientes', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('app.app_id_key'),
                        'Accept' => 'application/json',
                    ],
                    'form_params' => [
                        'numero_de_cliente' => $request->clave_cliente,
                        'nombre_del_titular' => $request->nombre,
                        'nombre_de_usuario' => $request->usuario,
                        'email' => $request->email,
                        'fk_rol' => 4,
                        'password' => $request->password,
                        'password_confirmation' => $request->password_confirmation
                    ]
                ]);
                $mensaje = json_decode($response->getBody()->getContents());
                //dd($mensaje);

                return redirect('/login')->with('message', $mensaje->message);
            } catch (RequestException $e) {
                if ($e->getCode() == 400) {
                    $msj = json_decode($e->getResponse()->getBody()->getContents());
                    
                    $arrayErrores = array();
                    
                    $i = 0;
                    foreach ($msj as $ms=>$m){
                        $arrayErrores[$i] = implode('\n', $m);
                        $i = $i + 1;
                    }

                    return redirect()->back()->withErrors($arrayErrores);
                } else {
                    dd($e);
                    abort($e->getCode());
                }
            }
        }
    }
}
