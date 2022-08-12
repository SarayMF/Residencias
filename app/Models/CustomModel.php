<?php namespace App\Models;


class CustomModel{
    
    protected $db;


    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function validarUsuario($curp, $correo){
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

    public function verificarToken($token, $id){
        $query = $this->db->query('SELECT * FROM linkpassword WHERE token = ? AND idUsuario = ?', [$token, $id] );
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function guardarContraseña($pass, $id){
        $query = $this->db->query('UPDATE usuario SET password = ? WHERE idUsuario = ?', [$pass, $id]);
        if($query==true){
            return true;
        }else return false;
    }

    public function borrarToken($token){
        $query = $this->db->query('DELETE FROM linkpassword WHERE token= ?', [$token]);
        if($query == true) return true;
        else return false;
    }

    public function obtenerPermisos($idUsuario){
        $sql = 'SELECT permisos.nombre
                FROM permisosusuario 
                LEFT JOIN permisos ON permisosusuario.idPermiso = permisos.idPermiso
                WHERE permisosusuario.idUsuario = ?';
        $query = $this->db->query($sql, [$idUsuario]);
        return $result = $query->getResult();
    }
}