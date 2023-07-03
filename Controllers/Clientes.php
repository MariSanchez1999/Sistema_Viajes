<?php
    class Clientes extends Controller{
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
            $verificar=$this->model->verificarPermiso($id_user, 'Ver_Clientes' , 'Crear_Cliente');
          if (!empty($verificar) ) {
         
            $this->views->getView($this, "index");
          } else {
             header('Location: '. base_url . 'Errors/permisos');
          }
          
          
        }
        public function listar()
        {
            $data = $this->model->getClientes();
           
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


   

        public function registrar()
        {
          
           
            $dni = $_POST['dni'];
           $nombre = $_POST['nombre'];
           $telefono = $_POST['telefono'];
           $direccion = $_POST['direccion'];
           $id = $_POST['id'];
           //Encriptar contraseña
           
           if (empty($dni) || empty($nombre) || empty($telefono)  || empty($direccion)) {
               $msg = "Todos los campos son obligatorios";
           }else {
        
            if ($id=="") {
                         $id_user = $_SESSION['id_usuario'];
            $verificar=$this->model->verificarPermiso($id_user, 'Crear_Cliente','Crear_Cliente');
          if (!empty($verificar) ) {
                $data=  $this->model->registrarCliente($dni,$nombre,$telefono,$direccion);
                if ($data == "ok") {
                   $msg = "si";
                }else if($data == "existe"){
                  
                   $msg = array('msg' => ' El dni ya existe', 'icono' => 'error' );

                }else {
                   
                    $msg = array('msg' => ' Error al registrar el Cliente', 'icono' => 'error' );
                }
            } else {
                $msg = array('msg' => ' No tienes Permisos para registrar clientes', 'icono' => 'warning' );
              }  
                
            }else {

                $id_user = $_SESSION['id_usuario'];
                $verificar=$this->model->verificarPermiso($id_user, 'Crear_Cliente','Crear_Cliente');
              if (!empty($verificar) ) {

                $data=  $this->model->modificarCliente($dni,$nombre,$telefono,$direccion, $id);
                if ($data == "modificado") {
                   $msg = "modificado";
                }else if($data=="existe") {
                    $msg ="dni ya Existe";
                }else{
                    $msg ="Error al modificar el Cliente"; 
                }
            } else {
            $msg = array('msg' => ' No tienes Permisos para Editar clientes', 'icono' => 'warning' );
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

