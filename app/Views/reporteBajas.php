<div class="main-container center">
    <div class="body-container entrada">

        <center>
            <h3>Reporte de bajas <i class="fas fa-file-excel"></i></h3>
        </center>
        <br><br>
        <div class="float-left">
            <a class="btn btn-success" href="<?php echo base_url('/Reporte de bajas/generar reporte')?>"><i class="fa fa-download"></i> Descargar excel</a>
        </div>
        <div class="float-right d-flex">
            <div class="input-group mb-3 d-contents">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
                <input type="search" class="form-control" id="buscar" placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
            </div>
        </div>

        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                    <th scope="col"># Activo</th>
                    <th scope="col"># Serie</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Fecha de baja</th>
                    <th scope="col">Dado de baja por</th>
                    </tr>
                </thead>
                <tbody id="listaActivos">
            
                </tbody>
            </table>
        </div>
        <center>
            <div id="loader" class=""></div>
        </center>
        <nav id="paginacion" aria-label="Page navigation example">
            <ul class="pagination justify-content-end pagination-sm activos-pag">
                
            </ul>
        </nav>
            
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script  src="<?php echo base_url('resources/js/mostrarBajas.js');?>" ></script> 