<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;
use App\Models\PermisosUsuarioModel;

class Activos extends BaseController{
    private $cModel;
    private $usuarioModel;
    private $linkModel;
    private $permisoModel;
    private $session;

    public function __construct(){
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->linkModel = new LinkModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function index(){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
            ];
            echo view('templates/header',$datos);
            echo view('registroActivos');
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    } 

    public function create(){

    }

    public function read(){
        if($this->request->isAJAX()){
            $buscar = $this->request->getPost('buscar');
            $pagina = $this->request->getPost('numpagina');
            $cantidad = 5;
            $inicio = ($pagina - 1) * 5;
            $datos = array(
                "usuarios" => $this->cModel->obtenerUsuarios($buscar, $inicio, $cantidad, $this->session->idUsuario),
                "cantidadUsuarios" => count($this->cModel->obtenerUsuario($buscar)),
            );
            echo json_encode($datos);
        
        }else{
            return redirect()->to(base_url('/Otorgar permisos'));
        }
    }
    public function update(){

    }
    
    public function delete(){

    }
}