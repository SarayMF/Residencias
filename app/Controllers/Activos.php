<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\ActivosModel;
use App\Models\PermisosUsuarioModel;

class Activos extends BaseController{
    private $cModel;
    private $usuarioModel;
    private $activosModel;
    private $permisoModel;
    private $session;

    public function __construct(){
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->activosModel = new ActivosModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function index(){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
            ];
            echo view('templates/header',$datos);
            echo view('mostrarActivos');
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
            $cantidad = 10;
            $inicio = ($pagina - 1) * 10;
            $datos = array(
                "activos" => $this->cModel->obtenerActivos($buscar, $inicio, $cantidad, $this->session->idUsuario),
                "cantidadActivos" => count($this->cModel->obtenerActivo($buscar)),
            );
            echo json_encode($datos);
        
        }else{
            return redirect()->to(base_url('/Otorgar permisos'));
        }
    }

    public function update($id){
        if($this->request->isAJAX()){

        }else{
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                'activo' => $this->activosModel->find($id),
                'titulo' => "Editar activo"
            ];
            echo view('templates/header',$datos);
            echo view('formularioActivos',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }
    
    public function delete(){

    }
}