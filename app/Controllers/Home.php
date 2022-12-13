<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;
use App\Models\PermisosUsuarioModel;

class Home extends BaseController
{
    private $cModel;
    private $usuarioModel;
    private $linkModel;
    private $permisoModel;

    public function __construct(){
        helper(['form']);
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->linkModel = new LinkModel();
        $this->permisoModel = new PermisosUsuarioModel();
    }

    public function index()
    { 
        $session = session();
        if($session->has('idUsuario')){
            $datos = [
                'permisos' => $this->permisoModel->where('permisosusuario.idUsuario',$session->idUsuario)
                                                 ->select('permisos.nombre')
                                                 ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                 ->orderBy('permisos.idPermiso', 'ASC')
                                                 ->findAll(),
                'uri' => service('uri'),
            ];
            echo view('templates/header', $datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            echo view('templates/header');
            echo view('login');
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }

    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }

    public function attemptLogin(){
        if($this->request->isAJAX()){
            $email = trim($this->request->getPost('correo'));
            $contraseña = trim($this->request->getPost('contraseña'));

            $datosUsuario = $this->usuarioModel->where('correo', $email)->first();

            if(count($datosUsuario) > 0){
                if(isset($datosUsuario['password'])){
                    if(password_verify($contraseña, $datosUsuario['password'])){
                        $data = [
                            "idUsuario" => $datosUsuario['idUsuario'],    
                            "permisos" => $this->permisoModel->select('permisos.nombre')
                                                            ->join('permisos', 'permisos.idPermiso = permisosusuario.idPermiso')
                                                            ->where('permisosusuario.idUsuario', $datosUsuario['idUsuario'])     
                                                            ->findAll()       
                        ];
            
                        $session = session();
                        $session->set($data);
                        $respuesta = array(
                            "type" => "success"
                        );
                    }else{
                        $respuesta = array(
                            "type" => "error",
                            "msg" => "Credenciales invalidas"
                        );
                    }
                }else{
                    $respuesta = array(
                        "type" => "error",
                        "msg" => "Aun no has completado tu registro"
                    );
                }
            }else{
                $respuesta = array(
                    "type" => "error",
                    "msg" => "Este usuario no se encuentra resigtrado en el sistema"          
                );
            }
            echo json_encode($respuesta);
        }else{
            return redirect()->to(base_url('/'));
        }
    }
}