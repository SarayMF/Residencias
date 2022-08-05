<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;

class Registrar extends BaseController{

    private $cModel; 
    private $linkModel;
    
    public function __construct(){
        helper(['form']);
        $this->cModel = new CustomModel();  
        $this->linkModel = new LinkModel();
    }

    public function completar($id, $token){
        if($this->cModel->verificarToken($token, $id)){
            $datos = [
                'token' => $token,
                'id' => $id,    
            ];
            echo view('templates/header');
            echo view('contraseña', $datos);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->route('Home');
        }
    }

    public function guardarContraseña(){
        if($this->request->getMethod() == 'post'){
            $rules = [
                "password1" => 'required|min_length[8]',
                "password2" => 'required|matches[password1]',
            ];
            if($this->validate($rules)){
                echo '<script type="text/javascript">
                        alert("Registro completo, ya puedes ingresar");
                        window.location.href = "'.base_url().'";
                        </script>';
            }
        }else{
            return redirect()->route('');
        }
    }

}