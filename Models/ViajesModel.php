<?php
class ViajesModel extends Query{
    private $usuario, $nombre, $clave, $id, $estado;
    public function __construct()
    {
        parent:: __construct();
    }
   
    //Obtener los colaboradores y su sucursal asignada
    public function getColaboradoresPorSucursal($sucursalId)
    {
    $sql = "SELECT c.* 
            FROM clientes c
            INNER JOIN asignaciones a ON c.id = a.id_colaborador
            WHERE a.id_sucursal = $sucursalId";
    $data = $this->selectAll($sql);
    return $data;
    }

//obtener sucursal
    public function getSucursal($table)
    {
        $sql = "SELECT * FROM $table ";
        $data = $this->selectAll($sql);
        return $data;
    }

//obtener transportista
    public function getTransportistas()
    {
        $sql = "SELECT * FROM transportista ";
        $data = $this->selectAll($sql);
        return $data;
    }


    //obtener los datos: distancia y tarifa
    public function getDatos(int $sucursal,int $colaborador)
    {
        $sql = "SELECT distancia,tarifa FROM asignaciones WHERE id_colaborador = $colaborador AND id_sucursal = $sucursal";
        $data = $this->selectAll($sql);
        return $data;
    }

    

//Registrar el viaje en una tabla temporal inicialmente
    
public function registrarDetalle( int $id_sucursal, int $id_colaborador, $distancia, $tarifa, int $id_usuario)
{
    $this->id_sucursal = $id_sucursal;
    $this->id_colaborador = $id_colaborador;
    $this->distancia = $distancia;
    $this->tarifa = $tarifa;

    // Verificar si ya existe un registro con la misma sucursal
    $verificarSucursal = "SELECT id_sucursal FROM temp_viajes WHERE id_sucursal != '$this->id_sucursal'";
    $existenciaSucursal = $this->select($verificarSucursal);
    if (!empty($existenciaSucursal)) {
        return "error: Ya existe un registro con una sucursal diferente.";
    }

    // Verificar si ya existe un registro con el mismo colaborador
    $verificarColaborador = "SELECT id_colaborador FROM temp_viajes WHERE id_colaborador = '$this->id_colaborador'";
    $existenciaColaborador = $this->select($verificarColaborador);
    if (!empty($existenciaColaborador)) {
        return "error: Ya existe un registro con el mismo colaborador.";
    }
    // Verificar si ya existe un registro con el mismo colaborador para la fecha actual
    $zonaHoraria = new DateTimeZone('America/Tegucigalpa'); // Zona horaria de Honduras
        
        $fechaActual = new DateTime('now', $zonaHoraria);
        $fechaActualString = $fechaActual->format('Y-m-d');
        $verificarColaboradorFecha = "SELECT * FROM detalleviajes WHERE id_colaborador = '$this->id_colaborador' AND DATE(fecha)= '$fechaActualString'";
        $existenciaColaboradorFecha = $this->select($verificarColaboradorFecha);

        if (!empty($existenciaColaboradorFecha)) {
        return "error: Ya existe un registro con el mismo colaborador para la fecha actual.";
}


    // Insertar el nuevo registro en la tabla
    $total_pagar = $distancia * $tarifa;

    $sql = "INSERT INTO temp_viajes (id_sucursal, id_colaborador, distancia, tarifa, id_usuario) VALUES (?,?,?,?,?)";
    $datos = array($id_sucursal, $id_colaborador, $distancia, $total_pagar, $id_usuario);
    $data = $this->save($sql, $datos);

    if ($data == 1) {
        return "ok";
    } else {
        return "error: Error al insertar el registro.";
    }
}


    

   //Obtner detalle del viaje en la tabla temporal
    public function getDetalle(string $table )
    {
        $sql = "SELECT temp_viajes.id_colaborador, sucursales.sucursal AS sucursal, clientes.nombre AS colaborador, distancia, tarifa
        FROM $table
        JOIN sucursales ON temp_viajes.id_sucursal = sucursales.id
        JOIN clientes ON temp_viajes.id_colaborador = clientes.id";
        
        $data = $this->selectAll($sql);
        return $data;
    } 

    
     // Calcular el total de la tarifa  
       public function calcularTarifa(string $table, int $id_usuario)
       {
           $sql = "SELECT  SUM(tarifa) AS total FROM $table WHERE id_usuario = $id_usuario";
           $data = $this->select($sql);
           return $data;
       }
       
       //Calcular la distancia total
       public function calcularDistancia(string $table, int $id_usuario)
       {
           $sql = "SELECT  SUM(distancia) AS total_d FROM $table WHERE id_usuario = $id_usuario";
           $data = $this->select($sql);
           return $data;
       }

    //Obtener el id de la sucursal en

    public function getSucursalId($table, $id_usuario)
    {
    $sql = "SELECT id_sucursal FROM $table WHERE id_usuario = $id_usuario LIMIT 1";
    $data = $this->select($sql);
    return $data['id_sucursal']; 
    }

       
       
   //Id del viaje
       public function getId(string $table){
        $sql = "SELECT MAX(id) AS id FROM $table";
        $data= $this->select($sql);
        return $data;
    }

    //Registrar el viaje en la tabla viajes
    public function registrarViaje(int $id_transportista,int $id_sucursal, int $distancia_total, int $tarifa_total, int $id_usuario){
        $sql = "INSERT INTO viajes(id_transportista,id_sucursal,distancia_total,tarifa_total,id_usuario) VALUES (?,?,?,?,?)";
        $datos = array($id_transportista,$id_sucursal, $distancia_total,$tarifa_total,$id_usuario);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "ok";
        }else{
            $res = "error";
        }
        return $res;
       }
    
       //Registrar el detalle de cada viaje
       public function registrarDetalleViaje(int $id_viaje, int $id_colaborador, float $distancia, float $tarifa){
        
        $sql = "INSERT INTO detalleviajes (id_viaje, id_colaborador, distancia, tarifa) VALUES (?, ?, ?, ?)";
        $datos = array($id_viaje, $id_colaborador, $distancia, $tarifa);
        
        $data = $this->save($sql, $datos);
        
        if ($data) {
            $res = "ok";
        } else {
            $res = "error";
        }
        
        return $res;
    }
    
    

    public function verificarPermiso(int $id_user, string $nombre){
        $sql = "SELECT p.id, p.permiso, d.id, u.id, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso INNER JOIN usuarios u ON u.id_rol=d.id_rol WHERE u.id = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
   
    }

    public function vaciarDetalle(string $table, int $id_usuario) {
        $sql = "DELETE FROM $table WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data = $this->save($sql, $datos);
        if ($data) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    
    public function getHistorialViajes()
    {
        $sql = "SELECT v.id, t.nombre, s.id AS id_sucursal, v.tarifa_total, v.fecha FROM transportista t INNER JOIN viajes v ON v.id_transportista = t.id INNER JOIN sucursales s ON v.id_sucursal = s.id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRangoFechas(string $desde, string $hasta){
     
        $sql = "SELECT t.id, t.nombre, v.* 
        FROM transportista t 
        INNER JOIN viajes v ON v.id_transportista = t.id 
        WHERE v.fecha >= '$desde' AND v.fecha <= '$hasta' + INTERVAL 1 DAY
        ";
        $data = $this->selectAll($sql);
        return $data;
       } 




}

?>
