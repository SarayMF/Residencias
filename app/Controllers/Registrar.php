<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CustomModel;
use App\Models\LinkModel;
use App\Models\PermisosUsuarioModel;
use App\Models\AreaModel;
use App\Models\PuestoModel;

class Registrar extends BaseController{

    private $cModel; 
    private $linkModel;
    private $usuarioModel;
    private $permisoModel;
    private $areaModel;
    private $puestoModel;
    
    public function __construct(){
        helper(['form']);
        $this->cModel = new CustomModel();  
        $this->linkModel = new LinkModel();
        $this->usuarioModel = new UsuarioModel();
        $this->permisoModel = new PermisosUsuarioModel();
        $this->areaModel = new AreaModel();
        $this->puestoModel = new PuestoModel();
    }

    public function completar($id, $token){
        if(count($this->linkModel->where('token', $token)->where('idUsuario',$id)->find())>0){
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
        if($this->request->isAJAX()){
            $contraseña = $this->request->getPost('contraseña');
            $idUsuario = $this->request->getPost('idUsuario');
            $token = $this->request->getPost('token');
        
            $permisosDefault = [
                'idUsuario' => $idUsuario,
                'idPermiso' => 2
            ];

            $this->usuarioModel->where('idUsuario', $idUsuario)->set(['password' => password_hash($contraseña, PASSWORD_DEFAULT)])->update();
            $this->linkModel->where('token', $token)->delete();
            $this->permisoModel->save($permisosDefault);
            $data = array(
                "title" => "¡Registro completado!",
                "type" => "success",
                "mensaje" => "Ahora puedes ingresar con tu correo y contraseña",
            );
            
            echo json_encode($data);      
        }else return redirect()->to(base_url('/'));
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
                    'correo' => $this->request->getPost('correo'),
                ];
                if($this->usuarioModel->save($datos)){
                    $correo = $datos['correo'];
                    $idusuario=$this->usuarioModel->where('curp', $datos['curp'])->findColumn('idUsuario');
                    $link = $this->generarLinkTemporal($datos['curp'], $idusuario[0]); //manda a llamar al metodo que genera un link*/
                    
                    if($this->enviarCorreo($correo,$link)){ //se envia el link al correo registrado
                        $data = array(
                            "title" => "¡Registrado correctamente!",
                            "type" => "success",
                            "mensaje" => "Te hemos enviado un correo para completar tu registro",
                        );
                    }else{
                       $this->linkModel->where('idUsuario', $idusuario[0])->delete();
                        $this->usuarioModel->where('curp', datos['curp']);
                        $data = array(
                            "title" => "¡No se envio el correo!",
                            "type" => "warninng",
                            "mensaje" => "Error al enviar correo. Verifique su conexión o reporte a TI.",
                        );
                    }
                    
                    echo json_encode($data);
                }else{
                    $data = array(
                        "type" => "error",
                        "mensaje" => $this->usuarioModel->errors()
                    );
                    echo json_encode($data);
                }
            }else{
                $datos = [
                    'areas' => $this->areaModel->findAll()
                ];
                echo view('templates/header');
                echo view('register',$datos);
                echo view('templates/footer');
                echo view('templates/footer_js');
            }
        }else{
            return redirect()->to(base_url('/'));
        }
    }

    public function obtenerNombres(){
        if($this->request->isAJAX()){
            $url = 'http://187.191.30.131:4401/wsCurp/api/v1/curp/searchCurp/' . $this->request->getPost('curp');
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json; charset= utf-8',
                    'Authorization: Bearer '
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $response_arr = json_decode($response, true);

            if($response_arr['ok']){
                $data = array(
                    "status" => "success",
                    "nombre" => $response_arr['data']['name'],
                    "apellidoP" => $response_arr['data']['lastname'],
                    "apellidoM" => $response_arr['data']['surname']
                );

                echo json_encode($data);
            }else{
                $data = array(
                    "status" => "error"
                );

                echo json_encode($data);
            }


        }else return redirect()->to(base_url('/'));
    }

    public function obtenerPuestos(){
        if($this->request->isAJAX()){
           $idArea = $this->request->getPost('idArea');

           $puestos = $this->puestoModel->where('idArea', $idArea)->findAll();

           return json_encode($puestos);
        }else return redirect()->to(base_url('/'));
    }

    public function enviarCorreo($email, $link){
        $curl = curl_init();
        $fields = array('subject' => 'Completar registro', 'body' => $this->cuerpoEmail($link), 'addresses' => $email);
        $fields_json = json_encode($fields);
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://187.191.30.131:4401/wsCurp/api/v1/mailer/sendMail',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $fields_json,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset= utf-8',
                'Authorization: Bearer ',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response_arr = json_decode($response, true);

        return $response_arr['ok'];
    }

    public function generarLinkTemporal($curp,$id){
        $cadena = $curp.rand(1,9999999).date('Y-m-d');
        $token = sha1($cadena);
        
        $datos = [
            'idUsuario' => $id,
            'token' => $token,
        ];
        
        $this->linkModel->save($datos);

        $enlace = base_url().'/completarRegistro/'.$id.'/'.$token;
        return $enlace;
    }

    public function cuerpoEmail($link){
        $mensaje = '<html>
                        <head>
                            <title>Completar registro</title>
                        </head>
                        <body style="font-family:-apple-system,BlinkMacSystemFont,Arial,sans-serif">
                            
                           <center>
                             <div style="border: 5px solid #0361e2; box-shadow: 0px 0px 20px 4px #0361e2; padding:20px; border-radius: 10px; width: fit-content;">
                                 <center><h2>Portal de gestión de activos </h2>
                                 <p>Hemos recibido una petición para registrarte en el portal de activos juventudesGTO.</p>
                                 <p>Si hiciste esta petición, haz clic <a href="'.$link.'"> aqui</a>, de lo contrario puedes ignorar este correo.</p>
                                 <p>El link dejara de funcionar en 12hrs</p>
                                 </center>
                             </div>
                           </center>
                        </body>
                    </html>';
         
        return $mensaje;
    }
    
}
