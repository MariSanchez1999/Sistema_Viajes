<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4 bg-primary">
    <li class="breadcrumb-item active text-white"><h4>Sucursales</h4></li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmSucursal();"><i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblSucursal">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Direccion</th>
          
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div class="modal fade" id="nuevoSucursal" tabindex="-1" aria-labelledby="my_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="title">Nueva Sucursal</h5>
                <button class="close bg-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmSucursal">
                    <div class="form-floating mb-3">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombres">
                    </div>
                    <div class="form-group">
                       <label for="direccion">Direccion</label>
                       <textarea id="direccion" class="form-control" name="direccion" rows="3" placeholder="Direccion"></textarea>
                   </div>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarSucursal(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>
