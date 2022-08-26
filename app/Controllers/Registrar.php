<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;
use App\Models\PermisosUsuarioModel;

class Registrar extends BaseController{

    private $cModel; 
    private $linkModel;
    private $usuarioModel;
    private $permisoModel;
    
    public function __construct(){
        helper(['form']);
        $this->cModel = new CustomModel();  
        $this->linkModel = new LinkModel();
        $this->usuarioModel = new UsuarioModel();
        $this->permisoModel = new PermisosUsuarioModel();
    }

    public function completar($id, $token){
        if($this->cModel->verificarToken($token, $id)){
            $mensaje = 'Hola';
            $datos = [
                'token' => $token,
                'id' => $id    
            ];
            echo view('templates/header');
            echo view('contraseña', ['token' => $token,
                                     'idUsuario' => $id,]);
            echo view('templates/footer');
            echo view('templates/footer_js');
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function guardarContraseña(){
        if($this->request->getMethod() == 'post'){
            $rules = [
                "password1" => 'required|min_length[8]',
                "password2" => 'required|matches[password1]',
            ];
            if($this->validate($rules)){

                $pass = $this->request->getPost('password1');
                $usuario = $this->request->getPost('idUsuario');
                $token = $this->request->getPost('token');
                
                if($this->cModel->guardarContraseña(password_hash($pass, PASSWORD_DEFAULT), $usuario)){
                    if($this->cModel->borrarToken($token)){
                        echo '<script type="text/javascript">
                        alert("Registro completo, ya puedes ingresar");
                        window.location.href = "'.base_url().'";
                        </script>';
                    }
                }
            }
        }
    }

    public function registro(){
        $session = session();
        if(!$session->has('idUsuario')){
            if($this->request->isAJAX()){
                $datos = [
                    'curp' => $this->request->getPost('curp'),
                    'nombre' => $this->request->getPost('nombre'),
                    'apellidoP' => $this->request->getPost('apellidoP'),
                    'apellidoM' => $this->request->getPost('apellidoM'),
                    'puesto' => $this->request->getPost('puesto'),
                    'area' => $this->request->getPost('area'),
                    'correo' => $this->request->getPost('correo'),
                ];
                if($this->usuarioModel->save($datos)){
                    $link = $this->generarLinkTemporal($datos['curp']); //manda a llamar al metodo que genera un link
                    $correo = $datos['correo'];
                    $idusuario=$this->cModel->obtenerIdUsuario($datos['curp']);

                    $datos = [
                        'idUsuario' => $idusuario,
                        'idPermiso' => 2
                    ];
                    $this->permisoModel->save($datos);

                    $this->enviarEmail($correo,$link); //se envia el link al correo registrado
                    
                    $data = array(
                        "title" => "¡Registrado correctamente!",
                        "type" => "success",
                        "mensaje" => "Te hemos enviado un correo para completar tu registro",
                    );
                    
                    echo json_encode($data);
                }else{
                    $data = array(
                        "type" => "error",
                        "mensaje" => $this->usuarioModel->errors()
                    );
                    echo json_encode($data);
                }
            }else{
                echo view('templates/header');
                echo view('register');
                echo view('templates/footer');
                echo view('templates/footer_js');
            }
        }else{
            return redirect()->to(base_url('/'));
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

        $enlace = base_url().'/completarRegistro/'.$idusuario.'/'.$token;
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
