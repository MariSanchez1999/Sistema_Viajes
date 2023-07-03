<?php
class SucursalesModel extends Query{
    private $dni, $sucursales, $telefono, $direccion, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getSucursales(string $table)
    {
        $sql = "SELECT * FROM $table";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarSucursales(string $sucursales, string $direccion)
    {
        $this->sucursales = $sucursales;
        $this->direccion = $direccion;
        $verficar = "SELECT * FROM sucursales WHERE sucursal = '$this->sucursales'";
        $existe = $this->select($verficar);
        if (empty($existe)) {
            # code...
            $sql = "INSERT INTO sucursales(sucursal,direccion) VALUES (?,?)";
            $datos = array($this->sucursales,$this->direccion);
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
    public function modificarSucursales(string $sucursales, int $id)
    {
        $this->sucursales = $sucursales;
        $this->id = $id;
        $sql = "UPDATE sucursales SET sucursal = ? WHERE id = ?";
        $datos = array($this->sucursales, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarSucursales(int $id)
    {
        $sql = "SELECT * FROM sucursales WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }
   
    
    public function verificarPermiso(int $id_user, string $nombre){
        $sql = "SELECT p.id, p.permiso, d.id, u.id, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso INNER JOIN usuarios u ON u.id_rol=d.id_rol WHERE u.id = $id_user AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
   
    }
    
     
  
    





}
