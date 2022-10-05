<?php namespace App\Models;

use CodeIgniter\Model;

class AccesoriosModel extends Model
{
    protected $table      = 'accesorio';
    protected $primaryKey = 'idAccesorio';

    protected $allowedFields = ['nombre', 'cantidad'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected $createdField  = 'fechaRegistro';
    protected $deletedField  = 'fechaEliminacion';
    protected $updatedField  = 'fechaActualizacion';
    
}