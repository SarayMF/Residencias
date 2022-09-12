<?php namespace App\Models;

use CodeIgniter\Model;

class ActivosModel extends Model
{
    protected $table      = 'activos';
    protected $primaryKey = 'idActivo';

    protected $allowedFields = ['noActivo', 'noSerie', 'marca', 'modelo', 'memoriaRAM', 'discoDuro', 'procesador', 'idAsignacion','estado','usuarioBaja'];
    
    protected $useSoftDeletes = true;
    
    protected $useTimestamps = true;
    protected $createdField  = 'fechaAlta';
    protected $deletedField  = 'fechaBaja'

    protected $updatedField  = false;

    protected $validationRules = [
        'noActivo' => 'trim|required|is_unique[activos.noActivo]',
        'noSerie' => 'trim|required|valid_email|is_unique[activos.noSerie]'
    ];
    protected $validationMessages = [
        'noActivo' => [
            'is_unique' => 'El numero de activo ya esta registrado',
        ],
        'noSerie' => [
            'is_unique' => 'El numero de serie ya esta registrado',
        ],
    ];
    protected $skipValidation  = false;
}