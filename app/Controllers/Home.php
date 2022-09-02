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
                'permisos' => $this->cModel->obtenerPermisos($session->idUsuario)
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
        $email = trim($this->request->getPost('correo'));
        $contraseña = trim($this->request->getPost('contraseña'));

        $datosUsuario = $this->usuarioModel->where('correo', $email)->find();

        if(count($datosUsuario) > 0){
            if(isset($datosUsuario[0]['password'])){
                if(password_verify($contraseña, $datosUsuario[0]['password'])){
                    $data = [
                        "idUsuario" => $datosUsuario[0]['idUsuario'],                
                    ];
        
                    $session = session();
                    $session->set($data);
                    return redirect()->to(base_url('/'));
                }else{
                    return redirect()->to(base_url('/'))->with('msg', [
                        'body' => 'Credenciales invalidas',
                    ]);
                }
            }else{
                return redirect()->to(base_url('/'))->with('msg', [
                    'body' => 'Aun no has completado tu registro',
                ]);
            }
        }else{
            return redirect()->to(base_url('/'))->with('msg', [
                'body' => 'Este usuario no se encuentra resigtrado en el sistema',
            ]);
        }

    }

}