<?php namespace App\Models;

use CodeIgniter\Model;

class AsignacionModel extends Model
{
    protected $table      = 'idAsignacion';
    protected $primaryKey = 'idAplicacion';

    protected $allowedFields = ['usuarioAsigna','usuarioAsignado','observaciones','cantidad'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaAsignacion';
    protected $updatedField  = false;


}
