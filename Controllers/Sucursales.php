<?php
class Sucursales extends Controller{
    public function __construct() {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: ".base_url);
        }
        parent::__construct();
    }
    public function index()
    {
        
        $id_user = $_SESSION['id_usuario'];
        $verificar=$this->model->verificarPermiso($id_user, 'Sucursales');
      if (!empty($verificar) ) {
        $this->views->getView($this, "index");
      } else {
         header('Location: '. base_url . 'Errors/permisos');
      }
      }  

   

    public function listar()
    {
        $data = $this->model->getSucursales('sucursales');
      
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function registrar()
    {
        $sucursales = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $id = $_POST['id'];
        if (empty($sucursales) || empty($direccion)) {
            $msg = "Todos los campos son obligatorios";
        }else{
            if ($id == "") {
                    $data = $this->model->registrarSucursales($sucursales,$direccion);
                    if ($data == "ok") {
                        $msg = "si";
                     }else if($data == "existe"){
                        $msg = "La sucursal ya existe";
                     }else {
                         $msg ="Error al registrar sucursal";
                     }
                     
            }else{
                $data = $this->model->modificarSucursales($sucursales, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                 }else if($data=="existe") {
                     $msg ="Ya existe";
                 }else{
                     $msg ="Error al modificar"; 
                 }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
   
    
    
   
    
}
