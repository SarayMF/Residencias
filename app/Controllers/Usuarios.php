<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class Usuarios extends BaseController{
    private $usuarioModel;
    private $session;

    public function __construct(){
        $this->usuarioModel = new UsuarioModel();  
        $this->session = session();
    }

    public function usuarios(){
        if($this->request->isAJAX()){
            $busqueda = $this->request->getVar('q');
            $listaUsuarios = $this->usuarioModel->select('CONCAT(nombre," ",apellidoP," ",apellidoM) as nombre')
                                                ->like('CONCAT(nombre," ",apellidoP," ",apellidoM)', $busqueda)
                                                ->get();
            echo json_encode($listaUsuarios);
        }else{
            return redirect()->to(base_url('/'));
        }       
    }
}