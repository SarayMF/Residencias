<?php

namespace App\Controllers;
use App\Models\AccesoriosModel;
use App\Models\PermisosUsuarioModel;

class Accesorios extends BaseController{
    private $accesoriosModel;
    private $permisoUModel;
    private $session;

    public function __construct(){
        $this->accesoriosModel = new AccesoriosModel();
        $this->permisoUModel = new PermisosUsuarioModel();
        $this->session = session();
    }

    public function create(){
        if($this->request->isAJAX()){
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'cantidad' => $this->request->getPost('cantidad')
            ];
            $accesorios = $this->accesoriosModel->where('nombre',$datos['nombre'])->first();

            if(is_null($accesorios)){
                $this->accesoriosModel->save($datos);
                $respuesta = array(
                    "tipo" => "success",
                    "mensaje" => "Accesorio registrado correctamente",
                    "titulo" => "¡Exito!"
                );
            }else{
                $this->accesoriosModel->update($accesorios['idAccesorio'],$datos);
                $respuesta = array(
                    "tipo" => "success",
                    "mensaje" => "El accesorio ya existia, por lo que se actualizo el registro",
                    "titulo" => "¡Exito!"
                );
            }

            echo json_encode($respuesta);
        }else{
            $datos = [
                'permisos' => $this->permisoUModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'titulo' => 'Agregar accesorio nuevo',
            ];
            echo view('templates/header',$datos);
            echo view('formularioAccesorio', $datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }

    public function read(){
        if($this->request->isAJAX()){
            $buscar = $this->request->getPost('buscar');
            $pagina = $this->request->getPost('numpagina');
            $cantidad = 5;
            $inicio = ($pagina - 1) * 5;
            $datos = array(
                "accesorios" => $this->accesoriosModel->like('nombre', $buscar)->limit($inicio, $cantidad)->find(),
                "cantidadAccesorios" => count($this->accesoriosModel->like('nombre', $buscar)->findAll()),
            );
            echo json_encode($datos);
        
        }else{
            return redirect()->to(base_url('/Entrada de activos'));
        }
    }

    public function update($id){
        if($this->request->isAJAX()){
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'cantidad' => $this->request->getPost('cantidad'),
            ];
            if($this->accesoriosModel->update($id, $datos)){
                $data = array(
                    "title" => "¡Exito!",
                    "type" => "success",
                    "mensaje" => "El accesorio ha sido editado correctamente",
                );
                
                echo json_encode($data);
            }else{
                $data = array(
                    "title" => "¡Error!",
                    "type" => "error",
                    "mensaje" => "Ah ocurrido un error, intentalo de nuevo",
                );
                echo json_encode($data);
            }
        }else{
            $datos = [
                'permisos' => $this->permisoUModel->where('permisosusuario.idUsuario',$this->session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'accesorio' => $this->accesoriosModel->find($id),
                'titulo' => 'Editar accesorio',
            ];
            echo view('templates/header',$datos);
            echo view('formularioAccesorio', $datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }

    public function delete(){
        if($this->request->isAJAX()){
            $idAccesorio = $this->request->getPost('accesorio');
            $cantidad = $this->accesoriosModel->select('cantidad')->find($idAccesorio);

            if( $this->accesoriosModel->where('idAccesorio', $idAccesorio)->set(['cantidad' => $cantidad['cantidad']-1])->update()){
                $data = array(
                    "title" => "¡Registro eliminado!",
                    "type" => "success",
                    "mensaje" => "La cantidad ha sido actualizada correctamente",
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
        }else{
            return redirect()->to(base_url('/Entrada de activos'));
        }
    }
}
