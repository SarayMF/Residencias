<?php

namespace App\Controllers;
use App\Models\CustomModel;
use App\Models\ActivosModel;
use App\Models\AplicacionesModel;
use App\Models\PermisosUsuarioModel;

class Asignacion extends BaseController{
    private $cModel;
    private $aplicacionesModel;
    private $activosModel;
    private $permisoModel;
    private $session;

    public function __construct(){
        $this->cModel = new CustomModel();  
        $this->aplicacionesModel = new AplicacionesModel();
        $this->activosModel = new ActivosModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function index(){

    }

    public function create($id){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
            ];
            echo view('templates/header',$datos);
            echo view('asignarActivo',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function buscarUsuario(){
        if($this->session->has('idUsuario')){
            if($this->request->isAJAX()){
                
            }
        }else{
            return redirect()->to(base_url('/'));
        }
    }
}