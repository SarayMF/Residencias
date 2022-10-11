<?php

namespace App\Controllers;
use App\Models\CustomModel;
use App\Models\ActivosModel;
use App\Models\AplicacionActivoModel;
use App\Models\PermisosUsuarioModel;

class Activos extends BaseController{
    private $cModel;
    private $aplicacionesModel;
    private $activosModel;
    private $permisoModel;
    private $session;
    private $type;

    public function __construct(){
        $this->cModel = new CustomModel();  
        $this->aplicacionesModel = new AplicacionActivoModel();
        $this->activosModel = new ActivosModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function entradaDeActivos(){
        if($this->session->has('idUsuario')){
            $this->type = "Entrada";
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                'titulo' => $this->type,
            ];
            echo view('templates/header',$datos);
            echo view('mostrarActivos',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function salidaDeActivos(){
        if($this->session->has('idUsuario')){
            $this->type = "Salida";
            $datos = [
                'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                'titulo' => $this->type,
            ];
            echo view('templates/header',$datos);
            echo view('mostrarActivos',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function create(){
        if($this->session->has('idUsuario')){
            if($this->request->isAJAX()){

            }else{
                $datos = [
                    'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                    'titulo' => "Registar activo nuevo"
                ];
                echo view('templates/header',$datos);
                echo view('formularioActivos',$datos);
                echo view('templates/footer');
                echo view('templates/footer_js');
            }
        }
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
            return redirect()->to(base_url('/Entrada de activos'));
        }
    }

    public function update($id){
        if($this->session->has('idUsuario')){
            if($this->request->isAJAX()){

            }else{
                $datos = [
                    'permisos' => $this->cModel->obtenerPermisos($this->session->idUsuario),
                    'activo' => $this->activosModel->find($id),
                    'aplicaciones' => $this->aplicacionesModel->where('idActivo', $id)
                                ->select('aplicaciones.idAplicacion, aplicaciones.nombre')
                                ->join('aplicaciones', 'aplicaciones.idAplicacion = activoaplicaciones.idAplicacion')
                                ->findAll(),
                    'titulo' => "Editar activo"
                ];
                echo view('templates/header',$datos);
                echo view('formularioActivos',$datos);
                echo view('templates/footer');
                echo view('templates/footer_js');
            }
        }
    }
    
    public function delete(){
        if($this->request->isAJAX()){
            $idActivo = $this->request->getPost('activo');

            if($this->activosModel->where('idActivo',$idActivo)->delete()){
                $this->activosModel->where('idActivo', $idActivo)->set(['usuarioBaja' => $this->session->get('idUsuario'), 'estado' => 0])->update();
                $data = array(
                    "title" => "¡Registro eliminado!",
                    "type" => "success",
                    "mensaje" => "Registro eliminado correctamente",
                );
                echo json_encode($data);
            }else{
                $data = array(
                    "title" => "Error",
                    "type" => "error",
                    "mensaje" => "Ocurrio un error en la eliminacion del registro",
                );
                echo json_encode($data);
            }
        }
    }

    public function buscarActivo(){
        if($this->request->isAJAX()){
            $activo = $this->activosModel->where('noActivo', $this->request->getPost('noActivo'))->first();

            if(isset($activo)){
                if(is_null($activo['idAsignacion'])){
                    $data = array(
                        "type" => "success",
                        "activo" => $activo,
                    );
                }else{ 
                    $data = array(
                        "type" => "warning",
                        "activo" => $activo,
                    );
                }
            }else{
                $data = array(
                    "type" => "error",
                    "dato" => $this->request->getPost('noActivo')
                );
            }

            echo json_encode($data);
        }
    }
}