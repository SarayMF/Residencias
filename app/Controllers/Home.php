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
        helper(['form']);
        $this->cModel = new CustomModel();  
        $this->usuarioModel = new UsuarioModel();
        $this->linkModel = new LinkModel();
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
                'body' => 'Este usuario no se encuentra resigtrado en el sistema',
            ]);
        }

    }

    public function registro(){
        $session = session();
        if(!$session->has('idUsuario')){
            if($this->request->getMethod() == 'post'){
                if($this->usuarioModel->save($_POST)){
                    $link = $this->generarLinkTemporal($this->request->getPost('curp')); //manda a llamar al metodo que genera un link
                    $correo = $this->request->getPost('correo');

                    $this->enviarEmail($correo,$link); //se envia el link al correo registrado
                    echo '<script type="text/javascript">
                            alert("Te hemos enviado un correo para que completes tu registro");
                            window.location.href = "'.base_url().'";
                            </script>';
                }else{
                    echo view('templates/header');
                    echo view('register', ['errors' => $this->usuarioModel->errors(),]);
                    echo view('templates/footer');
                    echo view('templates/footer_js');
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

