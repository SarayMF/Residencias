<?php namespace App\Models;


class CustomModel{
    
    protected $db;


    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function validateUsuario($curp, $correo){
        $sql  = 'SELECT * FROM usuario WHERE curp = ?';
        $query = $this->db->query($sql, [$curp]);
        $results = $query->getResult();
        $sql  = 'SELECT * FROM usuario WHERE correo = ?';
        $query = $this->db->query($sql, [$correo]);
        $results2 = $query->getResult();
        
        if (count($results) == 0 && count($results2) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerIdUsuario($curp){
        $query = $this->db->query('SELECT idUsuario FROM usuario WHERE curp = ?', [$curp]);
        $result = $query->getRow();
        return $result->idUsuario;
    }
}