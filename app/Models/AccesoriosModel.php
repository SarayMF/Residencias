<?php namespace App\Models;

use CodeIgniter\Model;

class AccessoriosModel extends Model
{
    protected $table      = 'accesorio';
    protected $primaryKey = 'idAccesorio';

    protected $allowedFields = ['nombre', 'cantidad'];
    
}