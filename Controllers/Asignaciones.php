<?php
    class Asignaciones extends Controller{
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
            $data['colaboradores']=$this->model->getCola();
            $data['sucursales']=$this->model->getSucursal();
            $this->views->getView($this, "index", $data);
          } else {
             header('Location: '. base_url . 'Errors/permisos');
          }
          



            
        }
        public function listar()
        {
            $data = $this->model->getAsignaciones();
           
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
            $sucursales = $_POST['sucursales'];
            $colaborador = $_POST['colaborador'];
            $distancia = $_POST['distancia'];
            $tarifa = $_POST['tarifa'];
            $id = $_POST['id'];
        
            // Verificar campos obligatorios
            if (empty($sucursales) || empty($colaborador) || empty($distancia) || empty($tarifa)) {
                $msg = "Todos los campos son obligatorios";
            } else {
                // Verificar restricción de distancia
                if ($distancia <= 0 || $distancia > 50) {
                    $msg = "La distancia debe estar entre 1 y 50";
                } else {
                    if ($id == "") {
                        $data = $this->model->registrarAsignacion($sucursales, $colaborador, $distancia,$tarifa);
                        if ($data == "ok") {
                            $msg = "si";
                        } else if ($data == "existe") {
                            $msg = "La asignación ya existe";
                        } else {
                            $msg = "Error al registrar asignación";
                        }
                    } else {
                        $msg = "El ID no puede estar vacío";
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

