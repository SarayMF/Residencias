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
}