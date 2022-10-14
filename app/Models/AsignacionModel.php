<?php namespace App\Models;

use CodeIgniter\Model;

class AsignacionModel extends Model
{
    protected $table      = 'asignacion';
    protected $primaryKey = 'idAplicacion';

    protected $allowedFields = ['usuarioAsigna','usuarioAsignado','observaciones','cantidad','idActivo','idAccesorio'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAsignacion';
    protected $updatedField  = false;


}