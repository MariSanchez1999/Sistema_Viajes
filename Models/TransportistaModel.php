<?php
class TransportistaModel extends Query{
    private  $nombre,  $id, $estado;
    public function __construct()
    {
        parent:: __construct();
    }

    public function getTransportista()
    {

       $sql = "SELECT * FROM transportista";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarTransportista(string $nombre, string $telefono)
    {
       
        $this->nombre = $nombre;
        $this->telefono = $telefono;
       
            $verificar = "SELECT * FROM transportista WHERE nombre = '$this->nombre'";
            $existe = $this->select($verificar);
            if (empty($existe)) {
            $sql = "INSERT INTO transportista(nombre, telefono) VALUES (?,?)";
            $datos = array($this->nombre,$this->telefono);
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
    public function modificarTransportista(string $nombre,string $telefono, int $id)
    { 
        


        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->id = $id;
        $vericar = "SELECT * FROM transportista WHERE nombre = '$this->nombre'";
        $comprobar = "SELECT * FROM transportista WHERE id = '$this->id' and nombre = '$this->nombre'";
        $existe = $this->select($vericar);
        $exist = $this->select($comprobar);
        if (  empty($existe) || !empty($exist)) {

            $sql = "UPDATE transportista SET  nombre = ?, telefono = ? WHERE id = ?";
            $datos = array( $this->nombre, $this->telefono, $this->id);
            $data = $this->save($sql, $datos);
            if ($data == 1 ) {
                $res = "modificado";
            } else {
                $res = "error";
            }
        }else{
       
            $res = "existe";
        }
        return $res;
    }

    public function editarTransportista(int $id)
    {
        $sql = "SELECT * FROM transportista WHERE id = $id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionProv(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE transportista SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    } 


    public function verificarPermiso(int $id_user, string $nombre , string $nombre2){
        $sql = "SELECT p.id, p.permiso, d.id, u.id, d.id_permiso FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso INNER JOIN usuarios u ON u.id_rol=d.id_rol WHERE u.id = $id_user AND (p.permiso = '$nombre' OR p.permiso ='$nombre2')";
        $data = $this->selectAll($sql);
        return $data;
   
    }
}

?>