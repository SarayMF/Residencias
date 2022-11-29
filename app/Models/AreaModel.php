<?php namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table      = 'areas';
    protected $primaryKey = 'idArea';

    protected $allowedFields = ['area'];    
}