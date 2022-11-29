<?php namespace App\Models;

use CodeIgniter\Model;

class PuestoModel extends Model
{
    protected $table      = 'puestos';
    protected $primaryKey = 'idPuesto';

    protected $allowedFields = ['puesto','idArea'];    
}