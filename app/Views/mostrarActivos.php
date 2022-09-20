<div class="main-container center">
    <div class="form-container entrada">

        <center>
            <h4><?php echo $titulo?> de activos</h4>
        </center>
        <input type="hidden" id="type" value="<?php echo $titulo?>">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="Activos-tab" data-toggle="tab" href="#Activos" role="tab" aria-controls="Activos" aria-selected="true">Activos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="Accesorios-tab" data-toggle="tab" href="#Accesorios" role="tab" aria-controls="Accesorios" aria-selected="false">Accesorios</a>
        </li>
        </ul>
        <br>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Activos" role="tabpanel" aria-labelledby="Activos-tab">
                <div class="float-right d-flex">
                
                    <div class="input-group mb-3 d-contents">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="search" class="form-control" id="buscar" placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
                    </div>
                    <div style="width:5px"></div>
                    <?php if($titulo == "Entrada"):?>
                        <a class="btn btn-primary" href="<?php echo base_url("/Entrada de activos/agregar")?>">Agregar</a>
                    <?php endif?>
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
                            <th scope="col">Fecha de alta</th>
                            <?php if($titulo == "Entrada"):?>
                                <th scope="col">Editar</th>
                                <th scope="col">Asignar</th>
                            <?php elseif($titulo == "Salida"):?>
                                <th scoope="col">Eliminar</th>
                            <?php endif?>
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
                    <ul class="pagination justify-content-end pagination-sm">
                        
                    </ul>
                </nav>
            </div>

            <div class="tab-pane fade" id="Accesorios" role="tabpanel" aria-labelledby="Accesorios-tab">
                Accesorios
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script  src="<?php echo base_url('resources/js/mostrarActivosAccesorios.js');?>" ></script> 
<?php if($titulo == "Entrada"):?>
                           
<?php elseif($titulo == "Salida"):?>
    
<?php endif?>