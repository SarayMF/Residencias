<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\PermisosModel;

class Permisos extends BaseController{
    private $permisoModel;
    private $usuarioModel;
    private $cModel;
    private $session;
    
    public function __construct(){
        $this->permisoModel = new PermisosModel();
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->session = session();
    }

    public function index(){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                'datospermiso' => $this->permisoModel->findAll(),
            ];
            echo view('templates/header',$datos);
            echo view('permisos', $datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }

    public function mostrar(){
        if($this->request->isAJAX()){
            $buscar = $this->request->getPost('buscar');

            $datos = $this->cModel->obtenerUsuarios($buscar);
            echo json_encode($datos);
        
        }else{
            show_404();
        }
    }
}