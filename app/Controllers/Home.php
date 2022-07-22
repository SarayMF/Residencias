<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;

class Home extends BaseController
{
    private $cModel;
    private $usuarioModel;
    private $linkModel;

    public function __construct(){
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->linkModel = new LinkModel();
    }

    public function index()
    { 
        echo view('templates/header');
        echo view('login');
        echo view('templates/footer');
        echo view('templates/footer_js');
    }

    public function login(){
        redirect('Home/');
    }

    public function register(){
        echo $this->generarLinkTemporal('MAFA971218MGTDRL03');
        if($this->request->getMethod() == 'post'){
            if($this->cModel->validateUsuario($_POST['curp'], $_POST['correo'])){ 
                $this->usuarioModel->save($_POST);
                echo '<script type="text/javascript">
                        alert("Te hemos enviado un correo para generar tu contraseña");
                        window.location.href = "'.base_url().'";
                        </script>';
            }else{
                $data = [
                    'error' => 1
                ]; 
                echo view('templates/header');
                echo view('register',$data);
                echo view('templates/footer');
                echo view('templates/footer_js');
            }
        }else{
            echo view('templates/header');
            echo view('register');
            echo view('templates/footer');
            echo view('templates/footer_js');
        }
    }

    public function generarLinkTemporal($curp){
        $cadena = $curp.rand(1,9999999).date('Y-m-d');
        $token = sha1($cadena);
        $idusuario=$this->cModel->obtenerIdUsuario($curp);

        $datos = [
            'idUsuario' => $idusuario,
            'token' => $token,
        ];
        
        $enlace = base_url().'/registrar/contraseña/'.sha1($idusuario).'/'.$token;
        return $enlace;
    }
    
}
