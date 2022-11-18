<div class="main-container center">
    <div class="form-container">

        <center><h4><?php echo $titulo?></h4></center>
        <br>
        <form action="" id="formularioActivo" method="post">
            <?php if(isset($activo)):?>
                <input type="hidden" value="<?php echo $activo['idActivo']?>" id="idActivo">
            <?php endif?>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend append-sm">
                            <span class="input-group-text" id="basic-addon1"># Activo</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" value="<?php if(isset($activo)) echo $activo['noActivo']?><?php if(isset($_GET['idActivo'])) echo $_GET['idActivo']?>" id="noActivo" placeholder="No. Activo" aria-label="No. activo" aria-describedby="basic-addon1" <?php if(isset($activo)) echo "disabled"?> required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend append-sm">
                            <span class="input-group-text" id="basic-addon1"># Serie</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" value="<?php if(isset($activo)) echo $activo['noSerie']?>" id="noSerie" placeholder="No. Serie" aria-label="No. Serie" aria-describedby="basic-addon1" <?php if(isset($activo)) echo "disabled"?> required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend append-sm">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-copyright"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-sm" value="<?php if(isset($activo)) echo $activo['marca']?>" id="marca" placeholder="Marca" aria-label="marca" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend append-sm">
                            <span class="input-group-text" id="basic-addon1">Modelo</span>
                        </div>
                        <input type="text" class="form-control form-control-sm" value="<?php if(isset($activo)) echo $activo['modelo']?>" id="modelo" placeholder="Modelo" aria-label="modelo" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-12 col-lg-4">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend append-sm">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-memory"></i></span>
                        </div>
                        <input type="number" class="form-control form-control-sm" value="<?php if(isset($activo)) echo $activo['memoriaRAM']?>" id="memoriaRAM" placeholder="Memoria RAM" aria-label="RAM" aria-describedby="basic-addon1">
                        <div class="input-group-append append-sm">
                            <span class="input-group-text" id="basic-addon2">GB</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend append-sm">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hdd"></i></span>
                        </div>
                        <input type="number" class="form-control form-control-sm" value="<?php if(isset($activo)) echo $activo['discoDuro']?>" id="discoDuro" placeholder="Disco duro" aria-label="Disco duro" aria-describedby="basic-addon1">
                        <div class="input-group-append append-sm">
                            <span class="input-group-text" id="basic-addon2">GB</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend append-sm">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-microchip"></i></span>
                        </div>
                        <input type="text" class="form-control form-control-sm" value="<?php if(isset($activo)) echo $activo['procesador']?>" id="procesador" placeholder="Procesador" aria-label="Procesador" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>          
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Observaciones</span>
                        </div>
                        <textarea class="form-control" id="observaciones"  aria-label="With textarea"><?php if(isset($activo)) echo $activo['observaciones']?></textarea>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12 col-lg-2"><h6>Aplicaciones:</h6></div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="input-group">
                        <select id="listaAplicaciones" multiple>
                            <?php foreach($aplicaciones as $app):?>
                                <option value="<?php echo $app['idAplicacion']?>" <?php if(isset($apps)):?><?=(in_array($app['idAplicacion'], array_column($apps, 'idAplicacion'))?"selected":"")?><?php endif?>><?php echo $app['nombre']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
            </div>
                   

            <div id="error">
                
            </div>

            <center>
                <div id="loader" class=""></div>
            </center>

            <div class="float-right">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <?php if(isset($activo)):?>
                    <a class="btn btn-danger" href="<?php echo base_url("Altas")?>" role="button">Cancelar</a>
                    <?php else:?>
                        <button class="btn btn-danger" type="button" id="cancelar">Cancelar</button>
                <?php endif?>

                
            </div>
        </form>
    
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php if(isset($activo)):?>
    <script  src="<?php echo base_url('resources/js/editarActivo.js');?>" ></script>
    <?php else:?>
    <script  src="<?php echo base_url('resources/js/guardarActivo.js');?>" ></script>
<?php endif?>
<script  src="<?php echo base_url('resources/js/aplicaciones.js');?>" ></script>