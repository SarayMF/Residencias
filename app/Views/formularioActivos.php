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
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"># Activo</span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['noActivo']?>" id="noActivo" placeholder="No. Activo" aria-label="No. activo" aria-describedby="basic-addon1" <?php if(isset($activo)) echo "disabled"?> required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"># Serie</span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['noSerie']?>" id="noSerie" placeholder="No. Serie" aria-label="No. Serie" aria-describedby="basic-addon1" <?php if(isset($activo)) echo "disabled"?> required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-copyright"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['marca']?>" id="marca" placeholder="Marca" aria-label="marca" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Modelo</span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['modelo']?>" id="modelo" placeholder="Modelo" aria-label="modelo" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-6 col-lg-4">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-memory"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['memoriaRAM']?>" id="memoriaRAM" placeholder="Memoria RAM" aria-label="RAM" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hdd"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['discoDuro']?>" id="discoDuro" placeholder="Disco duro" aria-label="Disco duro" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-microchip"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['procesador']?>" id="procesador" placeholder="Procesador" aria-label="Procesador" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-2"><h6>Aplicaciones:</h6></div>
                <div class="col-12"></div>
                
                <div style="margin-left: 30px;" id="aplicaciones">
                    <?php foreach($aplicaciones as $app):?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"  value="<?php echo $app["idAplicacion"]?>" id="<?php echo $app["idAplicacion"]?>" <?php if(isset($apps)):?><?=(in_array($app['idAplicacion'], array_column($apps, 'idAplicacion'))?"checked":"")?><?php endif?>>
                            <label class="custom-control-label" for="<?php echo $app["idAplicacion"]?>"><?php echo $app["nombre"]?></label>
                        </div>
                    <?php endforeach?>
                
                </div>
            </div>

            <div id="error">
                
            </div>

            <center>
                <div id="loader" class=""></div>
            </center>

            <div class="float-right">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="<?php echo base_url('/Entrada de activos')?>" role="button">Cancelar</a>
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
