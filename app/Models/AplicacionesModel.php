<?php namespace App\Models;

use CodeIgniter\Model;

class AplicacionesModel extends Model
{
    protected $table      = 'aplicaciones';
    protected $primaryKey = 'idAplicacion';

    protected $allowedFields = ['nombre'];

}
