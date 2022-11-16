<?php namespace App\Models;

use CodeIgniter\Model;

class AplicacionActivoModel extends Model
{
    protected $table      = 'activoaplicaciones';
    protected $primaryKey = 'idActivoAplicacion';

    protected $allowedFields = ['idActivo','listaApps'];

}
