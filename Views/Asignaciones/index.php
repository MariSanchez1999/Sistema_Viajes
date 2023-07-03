<?php 
    //print_r($_SESSION)
    include "Views/Templates/header.php";
?>
<ol class="breadcrumb mb-4 bg-primary">
    <li class="breadcrumb-item active text-white">
        <h4>Asignaciones</h4>
    </li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmAsignacion();"> <i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblAsignacion">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Colaborador</th>
            <th>Sucursal</th>
            <th>Distancia</th>
            
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="nuevo_asignacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nueva Asignacion</h5>
                <button class="close bg-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAsignacion">
                <div class="row" id="sucursalcol">
                <div class="col-6">
                <div class="form-group">
                
                        <label for="sucursales">Sucursal</label>
                        <input type="hidden" id="id" name="id">
                        <select id="sucursales" class="form-control" name="sucursales">
                            <?php foreach ($data['sucursales'] as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['sucursal']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    </div>
                    <div class="col-6">
                            <div class="form-group">
                        <label for="colaborador">Colaborador</label>
                        <select id="colaborador" class="form-control" name="colaborador">
                            <?php foreach ($data['colaboradores'] as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="distancia">Distancia Km:</label>
                        <input id="distancia" class="form-control" type="number" min="1" max="50"name="distancia" placeholder="Distancia">
                    </div>
                   
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                        <label for="tarifa">Tarifa L.</label>
                        <input id="tarifa" class="form-control" type="number" name="tarifa" placeholder="Tarifa">
                    </div>
                   
                    </div>
                    </div>
                    <button class="btn btn-primary mb-2" type="button" onclick="registrarAsignacion(event);"
                        id="btnAccion">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
    //print_r($_SESSION)
    include "Views/Templates/footer.php";

?>

tblAsignacion