<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'password'];

    public function buscarPorEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}