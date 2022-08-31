<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\PermisosModel;
use App\Models\PermisosUsuarioModel;

class Permisos extends BaseController{
    private $permisoModel;
    private $usuarioModel;
    private $cModel;
    private $session;
    
    public function __construct(){
        $this->permisoModel = new PermisosUsuarioModel();
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
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function mostrar(){
        if($this->request->isAJAX()){
            $buscar = $this->request->getPost('buscar');
            $pagina = $this->request->getPost('numpagina');
            $cantidad = 5;
            $inicio = ($pagina - 1) * 5;
            $datos = array(
                "usuarios" => $this->cModel->obtenerUsuarios($buscar, $inicio, $cantidad),
                "cantidadUsuarios" => count($this->cModel->obtenerUsuario($buscar)),
            );
            echo json_encode($datos);
        
        }else{
            
        }
    }

    public function permisosUsuario($idUsuario){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                'datosUsuario' => $this->usuarioModel->find($idUsuario),
                'datospermiso' => $this->permisoModel->where('idUsuario',$idUsuario)->findAll(),
            ];
            
            echo view('templates/header',$datos);
            echo view('editPermisos', $datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else return redirect()->to(base_url('/'));
    }
}