<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $allowedFields = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'puesto', 'area', 'correo', 'password'];
}