<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;

class Registrar extends BaseController{

    private $cModel; 
    
    public function __construct(){
        $this->cModel = new CustomModel();  
    }

    public function completar($id, $token){
        if($this->cModel->verificarToken($token)){
            echo view('templates/header');
            echo view('contraseña');
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->route('Home');
        }
    }

    public function guardarContraseña(){
        if($this->request->getMethod() == 'post'){

        }else{
            return redirect()->route('');
        }
    }

}