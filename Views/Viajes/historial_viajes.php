<?php include "Views/Templates/header.php";?>
<form action="<?php echo base_url; ?>Viajes/pdf" method="POST" target="_blank">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="min">Desde</label>
            <input type="date" value = "<?php echo date('Y-m-d'); ?>" name="desde" id="min">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="hasta">Hasta</label>
            <input type="date" value = "<?php echo date('Y-m-d'); ?>" name="hasta" id="hasta">
        </div>
    </div>

    
    <div class="col-md-3">
        <div class="form-group">
           <button type="submit" class="btn btn-danger">PDF</button>
        </div>
    </div>
</div>
</form>
<div class="card">
    <div class="card-header bg-dark text-white">
        Viajes
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered table-hover" id="t_historial_vi">
    <thead class="thead-dark" >
        <tr>
            <th>Id Viaje</th>
            <th>Transportista</th>
            <th>Sucursal</th>
            <th>Total a pagar</th>
            <th>Fecha de viaje</th>
            
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>