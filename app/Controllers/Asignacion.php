<?php

namespace App\Controllers;
use App\Models\CustomModel;
use App\Models\ActivosModel;
use App\Models\AplicacionesModel;
use App\Models\UsuarioModel;
use App\Models\AsignacionModel;

class Asignacion extends BaseController{
    private $cModel;
    private $usuarioModel;
    private $aplicacionesModel;
    private $activosModel;
    private $asignacionModel;
    private $session;

    public function __construct(){
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();  
        $this->aplicacionesModel = new AplicacionesModel();
        $this->activosModel = new ActivosModel();
        $this->asignacionModel = new AsignacionModel();
        $this->session = session();
    }

    public function asignacionActivo($id){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                'activo' => $this->activosModel->find($id)
            ];
            echo view('templates/header',$datos);
            echo view('asignarActivo',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function asignacionUsuario(){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
            ];
            echo view('templates/header',$datos);
            echo view('mostrarAsignaciones',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function createActivo(){
        if($this->request->isAJAX()){
            $noActivo = $this->request->getPost('noActivo');

            $idActivo = $this->activosModel->where('noActivo',$noActivo)->findColumn('idActivo');
            
            $datos = [
                'usuarioAsigna' => $this->session->idUsuario,
                'usuarioAsignado' => $this->request->getPost('usuarioAsignado'),
                'idActivo' => $idActivo[0],
                'observaciones' => $this->request->getPost('observaciones')
            ];

            if($this->asignacionModel->save($datos)){
                $idAsignacion = $this->asignacionModel->where('idActivo', $idActivo[0])->findColumn('idAsignacion');
                $this->activosModel->where('idActivo', $idActivo[0])->set(['idAsignacion' => $idAsignacion[0]])->update();
                $data = array(
                    "title" => "¡Asignacion realizada!",
                    "type" => "success",
                    "mensaje" => "Asignacion correctamente realizada",
                );
            }
            
            echo json_encode($data);
        }
    }

    public function buscarUsuario(){
        if($this->request->isAJAX()){
            $curp = $this->request->getPost('curp');

            $usuario = $this->usuarioModel->select('idUsuario, nombre, apellidoP, apellidoM')->where('curp',$curp)->first();

            if(isset($usuario)){
                $datos = array(
                    "usuario" => $usuario,
                    "type" => "success",
                );
            }else{
                $datos = array(
                    "type" => "error",
                );
            }
            echo json_encode($datos);
        }
    }
}