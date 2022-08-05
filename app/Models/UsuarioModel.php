<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $allowedFields = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'puesto', 'area', 'correo', 'password'];

    protected $validationRules = [
        'curp' => 'trim|required|is_unique[usuario.curp]',
        'correo' => 'trim|required|valid_email|is_unique[usuario.correo]'
    ];
    protected $validationMessages = [
        'correo' => [
            'is_unique' => 'El correo ya esta registrado',
        ],
        'curp' => [
            'is_unique' => 'El curp ya esta registrado',
        ],
    ];
    protected $skipValidation  = false;
}