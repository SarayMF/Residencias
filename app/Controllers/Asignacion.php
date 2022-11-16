<?php

namespace App\Controllers;
use App\Models\CustomModel;
use App\Models\ActivosModel;
use App\Models\AccesoriosModel;
use App\Models\AplicacionesModel;
use App\Models\UsuarioModel;
use App\Models\AsignacionModel;
use App\Models\PermisosUsuarioModel;

class Asignacion extends BaseController{
    private $cModel;
    private $usuarioModel;
    private $aplicacionesModel;
    private $activosModel;
    private $accesoriosModel;
    private $asignacionModel;
    private $permisoModel;
    private $session;

    public function __construct(){
        helper(['form']);
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();  
        $this->aplicacionesModel = new AplicacionesModel();
        $this->activosModel = new ActivosModel();
        $this->accesoriosModel = new AccesoriosModel();
        $this->asignacionModel = new AsignacionModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function index(){
        if(in_array('Mis activos', array_column($this->session->permisos, 'nombre'))){
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
        if(in_array('Asignar', array_column($this->session->permisos, 'nombre'))){
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'activo' => $this->activosModel->find($id),
                'listaUsuarios' => $this->usuarioModel->select('idUsuario, CONCAT(nombre," ",apellidoP," ",apellidoM) as nombre')
                                                      ->findAll()
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
        if(in_array('Mis activos', array_column($this->session->permisos, 'nombre'))){
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

    public function reasignar($id){
        if(in_array('Asignar', array_column($this->session->permisos, 'nombre'))){
            if($this->request->isAJAX()){
                $this->asignacionModel->where('idActivo', $id)->delete();

                $datos = [
                    'usuarioAsigna' => $this->session->idUsuario,
                    'usuarioAsignado' => $this->request->getPost('usuarioAsignado'),
                    'idActivo' => $id,
                    'observaciones' => $this->request->getPost('observaciones')
                ];
    
                if($this->asignacionModel->save($datos)){
                    $idAsignacion = $this->asignacionModel->where('idActivo', $id)->findColumn('idAsignacion');
                    $this->activosModel->where('idActivo', $id)->set(['idAsignacion' => $idAsignacion[0]])->update();
                    $data = array(
                        "title" => "¡Asignacion realizada!",
                        "type" => "success",
                        "mensaje" => "Asignacion correctamente realizada",
                    );
                }
                echo json_encode($data);
                
            }else{
                $asignacion = $this->asignacionModel->select('activo.idActivo, activo.noActivo, activo.marca, activo.modelo, usuario.idUsuario, usuario.nombre, usuario.apellidoP, usuario.apellidoM, asignacion.observaciones, asignacion.fechaBaja')
                                                    ->join('usuario', 'usuario.idUsuario = asignacion.usuarioAsignado')
                                                    ->join('activo', 'activo.idActivo = asignacion.idActivo')
                                                    ->where('activo.idActivo', $id)
                                                    ->first();
                $datos = [
                    'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                    ->select('permisos.nombre')
                                                    ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                    ->orderBy('permisos.idPermiso', 'ASC')
                                                    ->findAll(),
                    'asignacion' => $asignacion,
                    'listaUsuarios' => $this->usuarioModel->select('idUsuario, CONCAT(nombre," ",apellidoP," ",apellidoM) as nombre')
                                                          ->findAll()
                ];
                echo view('templates/header',$datos);
                echo view('asignarActivo',$datos);
                echo view('templates/footer');
                echo view('templates/footer_js');
            }
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function asignacionAccesorio($id){
        if(in_array('Asignar', array_column($this->session->permisos, 'nombre'))){
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'accesorio' => $this->accesoriosModel->find($id),
                'listaUsuarios' => $this->usuarioModel->select('idUsuario, CONCAT(nombre," ",apellidoP," ",apellidoM) as nombre')
                                                      ->findAll()
            ];
            echo view('templates/header',$datos);
            echo view('asignarAccesorio',$datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function asignacionAccesorioUsuario(){
        if(in_array('Mis activos', array_column($this->session->permisos, 'nombre'))){
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'usuario' => $this->usuarioModel->find($this->session->idUsuario),
                'listaAccesorios' => $this->accesoriosModel->findAll()
            ];
            echo view('templates/header',$datos);
            echo view('asignarAccesorio',$datos);
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
                                     ->limit($cantidad, $inicio)
                                     ->find(),
                "cantidadAsignacion" => count($this->asignacionModel->select('asignacion.idAsignacion, activo.noActivo, activo.marca, activo.modelo, asignacion.fechaAsignacion, asignacion.observaciones')
                                                   ->join('activo', 'asignacion.idAsignacion = activo.idAsignacion')
                                                   ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario')
                                                   ->where('asignacion.usuarioAsignado', $this->session->idUsuario)
                                                   ->find())
            );
            echo json_encode($datos);
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function readAccesorio(){
        if($this->request->isAJAX()){
            $buscar = $this->request->getPost('buscar');
            $pagina = $this->request->getPost('numpagina');
            $cantidad = 5;
            $inicio = ($pagina - 1) * 5;
            $datos = array(
                "accesorios" => $this->asignacionModel->select('asignacion.idAsignacion, accesorio.nombre, asignacion.cantidad, asignacion.fechaAsignacion, asignacion.observaciones')
                                     ->join('accesorio', 'asignacion.idAccesorio = accesorio.idAccesorio')
                                     ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario')
                                     ->like('accesorio.nombre', $buscar)
                                     ->where('asignacion.usuarioAsignado', $this->session->idUsuario)
                                     ->limit($cantidad, $inicio)
                                     ->find(),
                "cantidadAccesorios" => count($this->asignacionModel->select('asignacion.idAsignacion, activo.noActivo, activo.marca, activo.modelo, asignacion.fechaAsignacion, asignacion.observaciones')
                                                   ->join('activo', 'asignacion.idAsignacion = activo.idAsignacion')
                                                   ->join('usuario', 'asignacion.usuarioAsignado = usuario.idUsuario')
                                                   ->where('asignacion.usuarioAsignado', $this->session->idUsuario)
                                                   ->find())
            );
            echo json_encode($datos);
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
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function createAccesorio(){
        if($this->request->isAJAX()){
            $datos = [
                'usuarioAsigna' => $this->session->idUsuario,
                'usuarioAsignado' => $this->request->getPost('usuarioAsignado'),
                'idAccesorio' => $this->request->getPost('idAccesorio'),
                'cantidad' => $this->request->getPost('cantidad'),
                'observaciones' => $this->request->getPost('observaciones')
            ];
            $accesorio = $this->accesoriosModel->find($datos['idAccesorio']);
            
            if($datos['cantidad'] > 0){
                if($accesorio['cantidad'] >= $datos['cantidad']){
                    $cant=$accesorio['cantidad'] - $datos['cantidad'];
                    if($this->asignacionModel->save($datos)){
                        $this->accesoriosModel->where('idAccesorio', $datos['idAccesorio'])->set(['cantidad' => $cant])->update();
                        $data = array(
                            "title" => "¡Asignacion realizada!",
                            "type" => "success",
                            "mensaje" => "Asignacion correctamente realizada",
                        );
                    }
                }else{
                    $data = array(
                        "title" => "Atención",
                        "type" => "warning",
                        "mensaje" => "No hay suficiente cantidad en inventario",
                    );
                }
            }else{
                $data = array(
                    "title" => "Atención",
                    "type" => "warning",
                    "mensaje" => "La cantidad debe ser mayor a 0",
                );
            }
            echo json_encode($data);
        }else{
            return redirect()->to(base_url('/'));
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
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function deleteActivo(){
        if($this->request->isAJAX()){
            $idAsignacion = $this->request->getPost('asignacion');
            $this->activosModel->where('idAsignacion', $idAsignacion)->set(['idAsignacion' => null])->update();
            $this->asignacionModel->delete($idAsignacion);
            $data = array(
                "title" => "¡Exito!",
                "type" => "success",
                "mensaje" => "Asignacion eliminada",
            );
            echo json_encode($data);
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function deleteAccesorio(){
        if($this->request->isAJAX()){
            $idAsignacion = $this->request->getPost('asignacion');
            $datos = $this->asignacionModel->find($idAsignacion);
            $accesorio = $this->accesoriosModel->find($datos['idAccesorio']);
            $this->accesoriosModel->where('idAccesorio', $datos['idAccesorio'])->set(['cantidad' => $accesorio['cantidad'] + $datos['cantidad']])->update();
            $this->asignacionModel->delete($idAsignacion);
            $data = array(
                "title" => "¡Exito!",
                "type" => "success",
                "mensaje" => "Asignacion eliminada",
            );
            echo json_encode($data);
        }else{
            return redirect()->to(base_url('/'));
        }
    }
}