<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    protected $format = 'json';

    public function registro()
    {
        $model = new UsuarioModel();

        $json = $this->request->getJSON(true);

        if (!$json || !isset($json['email'], $json['nombre'], $json['password'])) {
            return $this->respond(['status' => 'error', 'mensaje' => 'Datos incompletos'], 400);
        }

        $datos = [
            'nombre'   => $json['nombre'],
            'email'    => $json['email'],
            'password' => password_hash($json['password'], PASSWORD_DEFAULT)
        ];

        if ($model->buscarPorEmail($datos['email'])) {
            return $this->respond(['status' => 'error', 'mensaje' => 'El email ya está registrado'], 400);
        }

        $model->insert($datos);
        return $this->respond(['status' => 'ok', 'mensaje' => 'Usuario registrado correctamente'], 201);
    }

    public function login()
    {
        $model = new UsuarioModel();

        $json = $this->request->getJSON(true);

        if (!$json || !isset($json['email'], $json['password'])) {
            return $this->respond(['status' => 'error', 'mensaje' => 'Datos incompletos'], 400);
        }

        $email    = $json['email'];
        $password = $json['password'];

        $usuario = $model->buscarPorEmail($email);

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            return $this->respond(['status' => 'error', 'mensaje' => 'Credenciales incorrectas'], 401);
        }

        return $this->respond(['status' => 'ok', 'mensaje' => 'Login exitoso', 'usuario' => $usuario['nombre']], 200);
    }
}