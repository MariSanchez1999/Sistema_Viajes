<?php
    class Usuarios extends Controller{
        public function __construct() {
            session_start();
           
            parent::__construct();
        }

        public function index()
        {


            $id_user = $_SESSION['id_usuario'];
            $verificar=$this->model->verificarPermiso($id_user, 'Usuarios');
          if (!empty($verificar) ) {
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
           // $data['cajas']=$this->model->getCajas();
            $data['roles']=$this->model->getRoles();
            //print_r($this->model->getUsuario());
            $this->views->getView($this, "index", $data);
          } else {
             header('Location: '. base_url . 'Errors/permisos');
          }
          



            
        }
        public function listar()
        {
            $data = $this->model->getUsuarios();
           
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function validar()
        {
            if (empty($_POST['usuario']) || empty($_POST['clave'])) {
                $msg = "¡Los campos estan vacios!";
            }else{
                $usuario = $_POST['usuario'];
                $clave = $_POST['clave'];
             
                $hash = hash("SHA256", $clave);
                $data = $this->model->getUsuario($usuario, $hash);
                if ($data) {
                    $_SESSION['id_usuario'] = $data['id'];
                    $_SESSION['usuario'] = $data['usuario'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['activo'] = true;
                    $msg = "ok";
                }else{
                    $msg =  "¡Usuario o contraseña incorrecta!";
                }

            }

            //print_r($data);
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function registrar()
        {
           $usuario = $_POST['usuario'];
           $nombre = $_POST['nombre'];
           $clave = $_POST['clave'];
           $confirmar = $_POST['confirmar'];
           $id = $_POST['id'];
           $rol = $_POST['rol'];
           //Encriptar contraseña
           $hash = hash("SHA256", $clave);
           if (empty($usuario) || empty($nombre)) {
               $msg = "Todos los campos son obligatorios";
           }else {
            if ($id=="") {
                if ($clave != $confirmar) {
                   $msg = "Las contraseñas no coinciden";
                }else if($clave==""){

                    $msg = "Ingrese contraseña"; 
                }else{
                    $data=  $this->model->registrarUsuario($usuario,$nombre,$hash,$rol);
                if ($data == "ok") {
                   $msg = "si";
                }else if($data == "existe"){
                   $msg = "El usuario ya existe";
                }else {
                    $msg ="Error al registrar el usuario";
                }
                }
                
            }
            
           }
        
        
           echo json_encode($msg, JSON_UNESCAPED_UNICODE);
           die();
        }
 

  
        public function salir()
        {
            session_destroy();
            header("location: ".base_url);
        }
    
    }
?>

