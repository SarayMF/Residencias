<?php namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table      = 'permisosusuario';
    protected $primaryKey = 'idPermisoUsuario';

    protected $allowedFields = ['idUsuario', 'idPermiso'];
    
}