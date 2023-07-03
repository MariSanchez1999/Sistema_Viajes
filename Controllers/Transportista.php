<?php
    class Transportista extends Controller{
        public function __construct() {
            session_start();
            if (empty($_SESSION['activo'])) {
                header("location: " . base_url);
            }
            parent::__construct();
        }

        public function index()
        {
            $id_user = $_SESSION['id_usuario'];
            $verificar=$this->model->verificarPermiso($id_user, 'Ver_transportista' , 'Crear_transportista');
          if (!empty($verificar) ) {
              $this->views->getView($this, "index");
          } else {
             header('Location: '. base_url . 'Errors/permisos');
          }
        }

        public function listar()
        {
            $data = $this->model->getTransportista();
          
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrar()
        {
           
           $nombre = $_POST['nombre'];
           $telefono = $_POST['telefono'];
           $id = $_POST['id'];
         
           
           if ( empty($nombre) || empty($telefono)) {
               $msg = "Todos los campos son obligatorios";
           }else {
            if ($id=="") {

                $id_user = $_SESSION['id_usuario'];
                $verificar=$this->model->verificarPermiso($id_user, 'Crear_transportista','Ver_transportista');
              if (!empty($verificar) ) {
                
                $data=  $this->model->registrarTransportista($nombre,$telefono);
                if ($data == "ok") {
                   $msg = "si";
                }else if($data == "existe"){
                   $msg = array('msg' => ' El Transportista ya existe', 'icono' => 'error' );
                }else {
                    $msg = array('msg' => ' Error al registrar el Transportista', 'icono' => 'error' );
                }
            } else {
                $msg = array('msg' => ' No tienes Permisos para registrar Transportista', 'icono' => 'warning' );
              }    
                
            }else {

                $id_user = $_SESSION['id_usuario'];
                $verificar=$this->model->verificarPermiso($id_user, 'Crear_transportista','Ver_transportista');
              if (!empty($verificar) ) {
                $data=  $this->model->modificarTransportista($nombre, $telefono,$id);
                if ($data == "modificado") {
                   $msg = "modificado";
                }else if($data=="existe") {
                    $msg = array('msg' => 'Transportista ya Existe', 'icono' => 'error' );
                }else{
                    $msg = array('msg' => 'Error al modificar el Transportista', 'icono' => 'error' );
                }

            } else {
                $msg = array('msg' => ' No tienes Permisos para Editar Proveedores', 'icono' => 'warning' );
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

