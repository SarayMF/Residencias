<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $allowedFields = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'idPuesto', 'correo', 'password'];

    protected $validationRules = [
        'nombre' => 'required',
        'curp' => 'trim|required|is_unique[usuario.curp]',
        'correo' => 'trim|required|valid_email|is_unique[usuario.correo]'
    ];
    protected $validationMessages = [
        'nombre' => [
            'required' => 'Se requiere nombre completo'
        ],
        'correo' => [
            'is_unique' => 'El correo ya esta registrado',
        ],
        'curp' => [
            'is_unique' => 'El curp ya esta registrado',
        ],
    ];
    protected $skipValidation  = false;
}