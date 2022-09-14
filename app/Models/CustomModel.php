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

    public function verificarToken($token, $id){
        $query = $this->db->query('SELECT * FROM linkpassword WHERE token = ? AND idUsuario = ?', [$token, $id] );
        $result = $query->getResult();
        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function obtenerPermisos($idUsuario){
        $sql = 'SELECT permisos.nombre
                FROM permisosusuario 
                LEFT JOIN permisos ON permisosusuario.idPermiso = permisos.idPermiso
                WHERE permisosusuario.idUsuario = ?
                Order by permisos.idPermiso';
        $query = $this->db->query($sql, [$idUsuario]);
        return $result = $query->getResult();
    }

    public function obtenerUsuarios($nombre,$inicio,$cantidad,$usuarioLogueado){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT idUsuario, curp, nombre, apellidoP, apellidoM FROM usuario WHERE nombre LIKE ? AND idUsuario != ? LIMIT ?,?';
        $query = $this->db->query($sql,[$cadena,$usuarioLogueado,$inicio,$cantidad]);
        
        return $result = $query->getResult();
    }

    public function obtenerUsuario($nombre){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT idUsuario, curp, nombre, apellidoP, apellidoM FROM usuario WHERE nombre LIKE ?';
        $query = $this->db->query($sql,[$cadena]);
        
        return $result = $query->getResult();
    }

    public function obtenerActivos($nombre,$inicio,$cantidad){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT * FROM activo WHERE noActivo LIKE ? LIMIT ?,?';
        $query = $this->db->query($sql,[$cadena,$inicio,$cantidad]);
        
        return $result = $query->getResult();
    }

    public function obtenerActivo($nombre){
        $cadena = "%".$nombre."%";
        $sql = 'SELECT * FROM activo WHERE noActivo LIKE ?';
        $query = $this->db->query($sql,[$cadena]);
        
        return $result = $query->getResult();
    }
}