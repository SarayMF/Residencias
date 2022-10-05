<?php

namespace App\Controllers;
use App\Models\AccesoriosModel;

class Accesorios extends BaseController{
    private $accesoriosModel;

    public function __construct(){
        $this->accesoriosModel = new AccesoriosModel();
    }

    public function create(){

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
