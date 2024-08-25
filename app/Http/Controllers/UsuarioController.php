<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderByDesc("id")->get();
        return view('usuarios', compact("usuarios"));
    }

    public function obtenerUsuario()
    {
        $response = Http::get('https://randomuser.me/api/');
        $userData = $response->json()['results'][0];

        $validationResult = $this->validarDatosUsuario([
            'title' => $userData['name']['title'],
            'first' => $userData['name']['first'],
            'last' => $userData['name']['last'],
            'city' => $userData['location']['city'],
            'state' => $userData['location']['state'],
            'country' => $userData['location']['country'],
            'postcode' => $userData['location']['postcode'],
            'email' => $userData['email'],
        ]);

        if ($validationResult->fails()) {
            return response()->json([
                "estatus" => false,
                "errores" => $validationResult->errors()->all()
            ]);
        }

        Usuario::create([
            'title' => $userData['name']['title'],
            'first' => $userData['name']['first'],
            'last' => $userData['name']['last'],
            'city' => $userData['location']['city'],
            'state' => $userData['location']['state'],
            'country' => $userData['location']['country'],
            'postcode' => $userData['location']['postcode'],
            'email' => $userData['email'],
        ]);

        return response()->json([
            "estatus" => true,
            "message" => 'Usuario guardado exitosamente.',
            "usuarios" => Usuario::orderByDesc("id")->get()
        ], 200);
    }

    public function guardarUsuario(Request $request) {
        $validacion = $this->validarDatosUsuario($request->all());

        if ($validacion->fails()) {
            return response()->json([
                'estatus' => false,
                'errores' => $validacion->errors()->all()
            ]);
        }

        Usuario::find($request->id)->update($request->all());

        return response()->json([
            "estatus" => true,
            "message" => 'Usuario guardado exitosamente.',
            "usuarios" => Usuario::orderByDesc("id")->get()
        ], 200);
    }

    private function validarDatosUsuario($userData)
    {
        return Validator::make([
            'title' => $userData['title'],
            'first' => $userData['first'],
            'last' => $userData['last'],
            'city' => $userData['city'],
            'state' => $userData['state'],
            'country' => $userData['country'],
            'postcode' => $userData['postcode'],
            'email' => $userData['email'],
        ], [
            'title' => 'required|string',
            'first' => 'required|string',
            'last' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'postcode' => 'required|numeric',
            'email' => 'required|email',
        ], [
            'string' => 'El campo :attribute debe ser un texto válido. Valor inválido: :input',
            'numeric' => 'El campo :attribute solo puede contener números. Valor inválido: :input',
            'email' => 'El campo :attribute debe ser una dirección de correo válida. Valor inválido: :input',
        ]);
    }
}

