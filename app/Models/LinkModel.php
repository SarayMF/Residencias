<?php namespace App\Models;

use CodeIgniter\Model;

class LinkModel extends Model
{
    protected $table      = 'linkpassword';
    protected $primaryKey = 'idLink';

    protected $allowedFields = ['idUsuario', 'token'];

    protected $useTimestamps = true;
    protected $createdField  = 'fechaCreacion';

    protected $updatedField  = false;

    protected $skipValidation  = false;
    protected $validationRules = [
        "idUsuario" => 'required|is_unique[linkpassword.idUsuario]',
    ]; 
}