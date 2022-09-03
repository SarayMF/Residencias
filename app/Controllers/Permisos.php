<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\PermisosModel;
use App\Models\PermisosUsuarioModel;

class Permisos extends BaseController{
    private $permisoUModel;
    private $permisoModel;
    private $usuarioModel;
    private $cModel;
    private $session;
    
    public function __construct(){
        $this->permisoUModel = new PermisosUsuarioModel();
        $this->permisoModel = new PermisosModel();
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->session = session();
    }

    public function index(){
        if($this->session->has('idUsuario')){
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
            ];
            echo view('templates/header',$datos);
            echo view('permisos');
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
                "usuarios" => $this->cModel->obtenerUsuarios($buscar, $inicio, $cantidad, $this->session->idUsuario),
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
                'datosPermisoUsuario' => $this->permisoUModel->where('idUsuario',$idUsuario)->findAll(),
                'listaPermisos' => $this->permisoModel->findAll(),
            ];
            
            echo view('templates/header',$datos);
            echo view('editPermisos', $datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else return redirect()->to(base_url('/'));
    }

    public function guardar(){
        if($this->request->isAJAX()){
            $idUsuario = $this->request->getPost('idUsuario');
            $permisos = json_decode($this->request->getPost('permisos'),true);
            $this->borrar($idUsuario);

            foreach($permisos as $p){
                $datos = [
                    'idUsuario' => $idUsuario,
                    'idPermiso' => $p,
                ];
                $this->permisoUModel->save($datos);
            }

            $data = array(
                "title" => "Permisos actualizados",
                "type" => "success",
                "mensaje" => "Los permisos del usuario han sido actualizados correctamente",
            );
            
            echo json_encode($data);
        }else return redirect()->to(base_url('/'));
    }

    public function borrar($idUsuario){
        $this->permisoUModel->where('idUsuario', $idUsuario)->delete();
    }

}
