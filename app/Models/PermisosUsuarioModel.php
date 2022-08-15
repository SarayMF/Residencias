<?php namespace App\Models;

use CodeIgniter\Model;

class PermisosUsuarioModel extends Model
{
    protected $table      = 'permisosusuario';
    protected $primaryKey = 'idPermisoUsuario';

    protected $allowedFields = ['idUsuario', 'idPermiso'];
    
}