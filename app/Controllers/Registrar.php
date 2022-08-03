<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;

class Registrar extends BaseController{

    public function completar($id, $token){
        echo view('templates/header');
        echo view('contraseña');
        echo view('templates/footer');
        echo view('templates/footer_js');
    }

}