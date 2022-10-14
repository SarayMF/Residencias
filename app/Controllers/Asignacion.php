<?php

namespace App\Controllers;
use App\Models\CustomModel;
use App\Models\ActivosModel;
use App\Models\AplicacionesModel;
use App\Models\UsuarioModel;
use App\Models\AsignacionModel;
use App\Models\PermisosUsuarioModel;

class Asignacion extends BaseController{
    private $cModel;
    private $usuarioModel;
    private $aplicacionesModel;
    private $activosModel;
    private $asignacionModel;
    private $permisoModel;
    private $session;

    public function __construct(){
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();  
        $this->aplicacionesModel = new AplicacionesModel();
        $this->activosModel = new ActivosModel();
        $this->asignacionModel = new AsignacionModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function index(){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
            ];
            echo view('templates/header',$datos);
            echo view('mostrarAsignaciones',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function asignacionActivo($id){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
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
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'usuario' => $this->usuarioModel->find($this->session->idUsuario)
            ];
            echo view('templates/header',$datos);
            echo view('asignarActivo',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function readActivo(){
        if($this->request->isAJAX()){
            $buscar = $this->request->getPost('buscar');
            $pagina = $this->request->getPost('numpagina');
            $cantidad = 5;
            $inicio = ($pagina - 1) * 5;
            $datos = array(
                "asignacion" => $this->asignacionModel->select('asignacion.idAsignacion, activo.noActivo, activo.marca, activo.modelo, asignacion.fechaAsignacion, asignacion.observaciones')
                                     ->join('activo', 'asignacion.idAsignacion = activo.idAsignacion')
                                     ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario')
                                     ->like('activo.noActivo', $buscar)
                                     ->where('asignacion.usuarioAsignado', $this->session->idUsuario)
                                     ->limit($inicio, $cantidad)
                                     ->find(),
                "cantidadAsignacion" => count($this->asignacionModel->select('asignacion.idAsignacion, activo.noActivo, activo.marca, activo.modelo, asignacion.fechaAsignacion, asignacion.observaciones')
                                                   ->join('activo', 'asignacion.idAsignacion = activo.idAsignacion')
                                                   ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario')
                                                   ->where('asignacion.usuarioAsignado', $this->session->idUsuario)
                                                   ->limit($inicio, $cantidad)
                                                   ->find())
            );
            echo json_encode($datos);
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