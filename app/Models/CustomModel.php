<?php namespace App\Models;


class CustomModel{
    
    protected $db;


    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function obtenerUsuarios($nombre,$inicio,$cantidad,$usuarioLogueado){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT idUsuario, curp, nombre, apellidoP, apellidoM FROM usuario WHERE nombre LIKE ? AND idUsuario != ? LIMIT ?,?';
        $query = $this->db->query($sql,[$cadena,$usuarioLogueado,$inicio,$cantidad]);
        
        return $result = $query->getResult();
    }

    public function obtenerUsuario($nombre,$usuarioLogueado){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT idUsuario, curp, nombre, apellidoP, apellidoM FROM usuario WHERE nombre LIKE ? AND idUsuario != ?';
        $query = $this->db->query($sql,[$cadena,$usuarioLogueado]);
        
        return $result = $query->getResult();
    }

    public function obtenerActivos($nombre,$inicio,$cantidad){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT * FROM activo WHERE noActivo LIKE ? AND estado = 1 LIMIT ?,?';
        $query = $this->db->query($sql,[$cadena,$inicio,$cantidad]);
        
        return $result = $query->getResult();
    }

    public function obtenerActivo($nombre){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT * FROM activo WHERE noActivo LIKE ? AND estado = 1';
        $query = $this->db->query($sql,[$cadena]);
        
        return $result = $query->getResult();
    }
}