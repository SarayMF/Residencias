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
        helper(['form']);
        $this->permisoUModel = new PermisosUsuarioModel();
        $this->permisoModel = new PermisosModel();
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->session = session();
    }

    public function index(){
        if(in_array('Permisos', array_column($this->session->permisos, 'nombre'))){
            $datos = [
                'permisos' => $this->permisoUModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'uri' => service('uri'),
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
            $cantidad = 10;
            $inicio = ($pagina - 1) * 10;
            $datos = array(
                "usuarios" => $this->cModel->obtenerUsuarios($buscar, $inicio, $cantidad, $this->session->idUsuario),
                "cantidadUsuarios" => count($this->cModel->obtenerUsuario($buscar, $this->session->idUsuario)),
            );
            echo json_encode($datos);
        
        }else{
            return redirect()->to(base_url('/Otorgar permisos'));
        }
    }

    public function permisosUsuario($idUsuario){
        if(in_array('Permisos', array_column($this->session->permisos, 'nombre'))){
            $datos = [
                'permisos' => $this->permisoUModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'datosUsuario' => $this->usuarioModel->find($idUsuario),
                'datosPermisoUsuario' => $this->permisoUModel->where('idUsuario',$idUsuario)->findAll(),
                'listaPermisos' => $this->permisoModel->findAll(),
                'uri' => service('uri'),
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
