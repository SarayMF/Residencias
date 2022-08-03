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

    public function registro(){
        if($this->request->getMethod() == 'post'){
            if($this->cModel->validateUsuario($_POST['curp'], $_POST['correo'])){ 
                $this->usuarioModel->save($_POST);
                //$this->request->getPost('filter'); 

                $link = $this->generarLinkTemporal($this->request->getPost('curp'));
                $correo = $this->request->getPost('correo');

                $this->enviarEmail($correo,$link);
                echo '<script type="text/javascript">
                        alert("Te hemos enviado un correo para que completes tu registro");
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
        
        $this->linkModel->save($datos);

        $enlace = base_url().'/completarRegistro/'.sha1($idusuario).'/'.$token;
        return $enlace;
    }

    public function enviarEmail( $email, $link ){
        $mensaje = '<html>
        <head>
        <title>Completar registro</title>
        </head>
        <body>
        <p>Hemos recibido una petición para registrarte en el portal de activos juventudesGTO.</p>
        <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
        <p>Recuerda que el link dejara de funcionar en 12hrs</p>
        <p>
        <strong>Enlace para completar tu registro</strong><br>
        <a href="'.$link.'"> Da clic aqui </a>
        </p>
        </body>
        </html>';
         
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $cabeceras .= 'From: smadrigal4935@gmail.com' . "\r\n";
        // Se envia el correo al usuario
        mail($email, "completar registro", $mensaje, $cabeceras);
    }
    
}

