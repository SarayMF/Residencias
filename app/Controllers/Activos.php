<?php

namespace App\Controllers;
use App\Models\CustomModel;
use App\Models\ActivosModel;
use App\Models\AplicacionActivoModel;
use App\Models\AplicacionesModel;
use App\Models\AsignacionModel;
use App\Models\PermisosUsuarioModel;

class Activos extends BaseController{
    private $cModel;
    private $aplicacionesActivoModel;
    private $aplicacionesModel;
    private $activosModel;
    private $asignacionModel;
    private $permisoModel;
    private $session;
    private $type;

    public function __construct(){
        helper(['form']);
        $this->cModel = new CustomModel();  
        $this->aplicacionesActivoModel = new AplicacionActivoModel();
        $this->aplicacionesModel = new AplicacionesModel();
        $this->activosModel = new ActivosModel();
        $this->asignacionModel = new AsignacionModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function entradaDeActivos(){
        if($this->session->has('idUsuario')){
            $this->type = "Entrada";
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'titulo' => "Entrada de activos",
                'tipo' => "Entrada"
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
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'titulo' => "Salida de activos",
                'tipo' => "Salida"
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
                $aplicaciones = json_decode($this->request->getPost('aplicaciones'),true);
                $datos = [
                    'noActivo' => $this->request->getPost('noActivo'),
                    'noSerie' => $this->request->getPost('noSerie'),
                    'marca' => $this->request->getPost('marca'),
                    'modelo' => $this->request->getPost('modelo'),
                    'memoriaRAM' => $this->request->getPost('memoriaRAM'),
                    'discoDuro' => $this->request->getPost('discoDuro'),
                    'procesador' => $this->request->getPost('procesador'),
                    'observaciones' => $this->request->getPost('observaciones')
                ];
                if($this->activosModel->save($datos)){
                    $idActivo = $this->activosModel->where('noActivo', $datos['noActivo'])->findColumn('idActivo');
                    foreach($aplicaciones as $a){
                        $datos = [
                            'idActivo' => $idActivo[0],
                            'idAplicacion' => $a,
                        ];
                        $this->aplicacionesActivoModel->save($datos);
                    }

                    $data = array(
                        "title" => "¡Exito!",
                        "type" => "success",
                        "mensaje" => "El activo ha sido registrado exitosamente",
                    );
                    
                    echo json_encode($data);
                }else{
                    $data = array(
                        "type" => "error",
                        "mensaje" => $this->activosModel->errors()
                    );
                    echo json_encode($data);
                }
            }else{
                $datos = [
                    'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                    'titulo' => "Registar activo nuevo",
                    'aplicaciones' => $this->aplicacionesModel->findAll()
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

    public function readDeleted(){
        if($this->request->isAJAX()){
            $buscar = $this->request->getPost('buscar');
            $pagina = $this->request->getPost('numpagina');
            $cantidad = 10;
            $inicio = ($pagina - 1) * 10;
            $datos = array(
                "activos" => $this->activosModel->select('activo.noActivo, activo.noSerie, activo.marca, activo.modelo, activo.fechaBaja, usuario.nombre, usuario.apellidoP, usuario.apellidoM')
                                                   ->join('usuario', 'activo.usuarioBaja = usuario.idUsuario')
                                                   ->like('noActivo', $buscar)
                                                   ->limit($cantidad, $inicio)
                                                   ->onlyDeleted()
                                                   ->find(),
                "cantidadActivos" => count($this->activosModel->like('noActivo', $buscar)->onlyDeleted()->findAll()),
            );
            echo json_encode($datos);
        }else{
            return redirect()->to(base_url());
        }
    }

    public function update($id){
        if($this->session->has('idUsuario')){
            if($this->request->isAJAX()){
                $aplicaciones = json_decode($this->request->getPost('aplicaciones'),true);
                $idActivo = $this->request->getPost('idActivo');
                $datos = [
                    'marca' => $this->request->getPost('marca'),
                    'modelo' => $this->request->getPost('modelo'),
                    'memoriaRAM' => $this->request->getPost('memoriaRAM'),
                    'discoDuro' => $this->request->getPost('discoDuro'),
                    'procesador' => $this->request->getPost('procesador'),
                    'observaciones' => $this->request->getPost('observaciones')
                ]; 
                if($this->activosModel->update($idActivo, $datos)){
                    $this->aplicacionesActivoModel->where('idActivo', $idActivo)->delete();
                    foreach($aplicaciones as $a){
                        $datos = [
                            'idActivo' => $idActivo,
                            'idAplicacion' => $a,
                        ];
                        $this->aplicacionesActivoModel->save($datos);
                    }

                    $data = array(
                        "title" => "¡Exito!",
                        "type" => "success",
                        "mensaje" => "El activo ha sido actualizado exitosamente",
                    );
                    
                    echo json_encode($data);
                }else{
                    $data = array(
                        "type" => "error",
                        "mensaje" => $this->activosModel->errors()
                    );
                    echo json_encode($data);
                }
            }else{
                $datos = [
                    'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                    'activo' => $this->activosModel->find($id),
                    'aplicaciones' => $this->aplicacionesModel->findAll(),
                    'apps' => $this->aplicacionesActivoModel->select('aplicaciones.idAplicacion, aplicaciones.nombre')
                                                            ->join('aplicaciones', 'aplicaciones.idAplicacion = activoaplicaciones.idAplicacion')
                                                            ->where('activoaplicaciones.idActivo',$id)
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
            $activo =  $this->activosModel->where('idActivo', $idActivo)->first();

            if($this->activosModel->where('idActivo',$idActivo)->delete()){
                $this->activosModel->where('idActivo', $idActivo)->set(['usuarioBaja' => $this->session->get('idUsuario'), 'estado' => 0])->update();
                if(isset($activo['idAsignacion'])){
                    $this->activosModel->where('idActivo', $idActivo)->set(['idAsignacion' => null])->update();
                    $this->asignacionModel->where('idActivo', $idActivo)->delete();
                } 
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