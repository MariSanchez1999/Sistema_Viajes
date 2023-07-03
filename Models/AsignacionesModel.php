<?php
class AsignacionesModel extends Query{
    private $usuario, $nombre, $clave, $id, $estado;
    public function __construct()
    {
        parent:: __construct();
    }
   
    public function getCola()
    {
        $sql = "SELECT * FROM clientes ";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getSucursal()
    {
        $sql = "SELECT * FROM sucursales ";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getAsignaciones()
    {
        $sql = "SELECT a.id, c.nombre AS Colaborador, s.sucursal AS Sucursal, a.distancia FROM asignaciones a JOIN clientes c ON a.id_colaborador = c.id JOIN sucursales s ON a.id_sucursal = s.id";
        $data = $this->selectAll($sql);
        return $data;
    }
    
    
    public function registrarAsignacion(int $sucursales, int $colaborador, float $distancia, float $tarifa )
    {
        $this->sucursales = $sucursales;
        $this->colaborador = $colaborador;
        $this->distancia = $distancia;
        $this->tarifa = $tarifa;

            $vericar = "SELECT * FROM asignaciones WHERE id_colaborador = '$this->colaborador' AND  id_sucursal = '$this->sucursales'";
            $existe = $this->select($vericar);
            if (empty($existe)) {
            $sql = "INSERT INTO asignaciones(id_colaborador, id_sucursal, distancia,tarifa) VALUES (?,?,?,?)";
            $datos = array($this->colaborador, $this->sucursales, $this->distancia,$this->tarifa);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
            }else{
            $res = "existe";
            }
            return $res;
    }
    
   



    public function verificarPermiso(int $id_user, string $nombre){
        $sql = "SELECT p.id, p.permiso, d.id, u.id, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso INNER JOIN usuarios u ON u.id_rol=d.id_rol WHERE u.id = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
   
    }

  


}

?>
