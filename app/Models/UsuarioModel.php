<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $allowedFields = ['curp', 'nombre', 'apellidoP', 'apellidoM', 'puesto', 'area', 'correo', 'password'];

    protected $beforeUpdate = ['hashPassword'];


    public function hashPassword(array $data){
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}