<?php 
    //print_r($_SESSION)
    include "Views/Templates/header.php";
?>


<div class="card">
<div class="card-header bg-primary text-white">
    <h4>Viajes</h4>
</div>
    <div class="card-body">
       <form  id= "frmViajes">
           <div class="row">
               <div class="col-md-4">
                    <div class="form-group">
                       <label for="sucursal">Sucursal</label>
                        <input type="hidden" id="id" name="id">
                        <select id="sucursales" class="form-control" name="sucursal" onchange="cargarColaboradores()">
                            <option  value="" disabled selected>Selecciona sucursal</option>
                                <?php foreach ($data['sucursales'] as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['sucursal']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

              </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="colaborador">Colaboradores</label>
                        <select id="colaborador" class="form-control" name="colaborador" onchange="mostrarDisTa()">
                        <option value="" disabled selected>Selecciona colaborador</option>
                        <?php if (isset($data['colaborador']) && is_array($data['colaborador'])) : ?>
                        <?php foreach ($data['colaborador'] as $row) : ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </select>
                    </div>
                </div>

              <div class="col-md-1">
                    <div class="form-group">
                        <label for="distancia">Distancia</label>
                        <input id="distancia" class="form-control" type="number" name="distancia" readonly>
                    </div>

              </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="tarifa">Tarifa</label>
                        <input id="tarifa" class="form-control" type="number" name="tarifa" readonly >
                    </div>

                </div>
                <div class="col-md-1" >
                    <div class="form-group" style = " margin-top: 30px">
                        <button class="btn btn-primary mb-2" type="button" onclick="registrarViaje(event)">Agregar</button>
                    </div>
                </div>
            </div>
         </form>
    </div>
</div>

<table class="table table-light table-bordered table-hover">
    <thead class= " thead-dark" >
        <tr>
          <th>Sucursal</th>
          <th>Colaborador</th>
          <th>Distancia</th>
          <th>Tarifa</th>
        
          <th></th>
        
        </tr>
    </thead>
    <tbody id="tblViajes">
    </tbody>
</table>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="transportistas">Seleccionar transportista</label>
            <select id="transportistas" class="form-control" name="transportistas">
            <option  value="" disabled selected>Selecciona transportista</option>
            <?php 
               foreach ($data['transportistas'] as $row) { ?>
                
              <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
              <?php }?>
            </select>
        </div>
    </div>
    <div class="col-md-3 ml-auto">
        <div class="form-group">
            
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="procesarViaje()">Guardar Viaje</button>
        </div>     

    </div>

</div>

<?php 
    //print_r($_SESSION)
    include "Views/Templates/footer.php";

?>

