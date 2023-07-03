<?php
    class Viajes extends Controller{
        public function __construct() {
            session_start();
           
            parent::__construct();
        }
        public function index()
        {
            $id_user = $_SESSION['id_usuario'];
            $verificar = $this->model->verificarPermiso($id_user, 'Crear_viaje');
            if (!empty($verificar)) {
                if (empty($_SESSION['activo'])) {
                    header("location: " . base_url);
                }
                $data['sucursales'] = $this->model->getSucursal('sucursales');
                $data['transportistas'] = $this->model-> getTransportistas();
                $this->views->getView($this, "index", $data);
            } else {
                header('Location: '. base_url . 'Errors/permisos');
            }
        }

        public function historial_viajes(){

            $id_user = $_SESSION['id_usuario'];
            $verificar=$this->model->verificarPermiso($id_user, 'Historial_Viajes' );
                if (!empty($verificar) ) {
                    
                    $this->views->getView($this, "historial_viajes");
                } else {
                header('Location: '. base_url . 'Errors/permisos');
                }
        
          
        }
       
    //Buscar los colaboradores por sucursal
        public function getColaboradoresBySucursal($sucursalId)
        {
            $colaboradores = $this->model->getColaboradoresPorSucursal($sucursalId);
            header('Content-Type: application/json');
            echo json_encode($colaboradores);

        }

//Buscar los datos: distancia  y tarifa
    public function buscarDatos()
    {
    $sucursal = $_GET['sucursal'];
    $colaborador = $_GET['colaborador'];
    $data = $this->model->getDatos($sucursal, $colaborador);
    header('Content-Type: application/json');
    echo json_encode($data);
    }

        
//Listar los viajes temporalmente
    public function listar($table)
    {
    $id_usuario = $_SESSION['id_usuario'];
    $data['temp_viajes'] = $this->model->getDetalle($table);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
    }
        
        



///// Ingresar los datos a la tabla temporal
public function ingresar()
{
    $id_usuario = $_SESSION['id_usuario'];

    $id_sucursal = $_POST['sucursal'];
    $id_colaborador = $_POST['colaborador'];
    $distancia = $_POST['distancia'];
    $tarifa = $_POST['tarifa'];

    // Verificar si los valores son nulos
    if ($distancia === "" || $tarifa === "") {
        $msg = "Error: los campos de distancia y tarifa son obligatorios.";
    } else {
        // Procesar los datos y guardarlos en la base de datos
        $data = $this->model->registrarDetalle( $id_sucursal, $id_colaborador, $distancia, $tarifa, $id_usuario);
        if ($data == "ok") {
            $msg = "ok";
        } elseif ($data == "error") {
            $msg = "Error al ingresar el detalle.";
        } else {
            $msg = "existe";
            
        }
    }

    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
}


//Registrar viaje y detalle de viajes a las tablas reales

public function registrarViaje($id_transportista)
{
    $id_usuario = intval($_SESSION['id_usuario']);
    $tarifa_total = $this->model->calcularTarifa('temp_viajes', $id_usuario);
    $distancia_total = $this->model->calcularDistancia('temp_viajes', $id_usuario);
    $id_sucursal = $this->model->getSucursalId('temp_viajes', $id_usuario);
    
    // Verificar si la distancia total es mayor que 100
    if ($distancia_total['total_d'] > 100) {
        $vaciar = $this->model->vaciarDetalle('temp_viajes', $id_usuario);
        
        if ($vaciar == 'ok') {
            $msg = 'La distancia total supera los 100 kilómetros. El viaje no puede ser registrado.';
            $icono = 'warning';
        } else {
            $msg = 'Error al vaciar los detalles del viaje';
            $icono = 'error';
        }
        
        echo json_encode(['msg' => $msg, 'icono' => $icono]);
        die();
    }
    
  

    $data = $this->model->registrarViaje($id_transportista, $id_sucursal, $distancia_total['total_d'], $tarifa_total['total'], $id_usuario);
    
    if ($data == 'ok') {
        $detalle = $this->model->getDetalle('temp_viajes', $id_usuario);
        $id_viaje = $this->model->getId('viajes');
        
        foreach ($detalle as $row) {
            $id_colaborador = $row['id_colaborador'];
            $distancia = $row['distancia'];
            $tarifa = $row['tarifa'];
            $this->model->registrarDetalleViaje($id_viaje['id'], $id_colaborador, $distancia, $tarifa);
        }
        
        $vaciar = $this->model->vaciarDetalle('temp_viajes', $id_usuario);
        
        if ($vaciar == 'ok') {
            $msg = 'ok';
            $icono = 'success';
        } else {
            $msg = 'Error al vaciar los detalles del viaje';
            $icono = 'error';
        }
    } else {
        $msg = 'Error al registrar el viaje';
        $icono = 'error';
    }

    echo json_encode(['msg' => $msg, 'icono' => $icono]);
    die();
}


public function listar_historial_viaje()
{
    $id_usuario = $_SESSION['id_usuario'];
    $data = $this->model->getHistorialViajes();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
}

public function pdf (){

    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    if (empty($desde) || empty($hasta)) {
        $data = $this->model->getHistorialViajes();
    }else{
        $data = $this->model->getRangoFechas($desde, $hasta);
    }
    
    require('Libraries/fpdf/fpdf.php');
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetMargins(10,0,0);
    $pdf->SetTitle('Reporte Viajes');
    $pdf->SetFont('Arial','B',12);
    $pdf->SetFillColor(0, 0, 0);
    $pdf->SetTextColor(255, 255, 255 );
    $pdf->Cell(10, 5, 'Id', 0, 0, 'L', true);
        $pdf->Cell(80, 5, 'Transportista', 0, 0, 'L',true);
        $pdf->Cell(40, 5, 'Total', 0, 0, 'L',true);
        $pdf->Cell(25, 5, 'Fecha', 0, 1, 'L',true);
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);
        //$pdf->Cell(10, 5, 'Hora', 0, 1, 'L');
    foreach ($data as $row) {
        $pdf->Cell(10, 5, $row['id'], 0, 0, 'L');
        $pdf->Cell(80, 5, $row['nombre'], 0, 0, 'L');
        $pdf->Cell(40, 5, $row['tarifa_total'], 0, 0, 'L');
        $pdf->Cell(25, 5, $row['fecha'], 0, 1, 'L');
        //$pdf->Cell(10, 5, $row['hora'], 0, 1, 'L');
    }
    
    $pdf->Output();
}


        
       
        public function salir()
        {
            session_destroy();
            header("location: ".base_url);
        }
    
    }
?>

