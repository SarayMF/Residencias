<div class="main-container center">
    <div class="form-container">

        <center><h4><?php echo $titulo?></h4></center>
        <br>
        <form action="" id="formularioActivo" method="post">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"># Activo</span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['noActivo']?>" id="noActivo" placeholder="No. Activo" aria-label="No. activo" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"># Serie</span>
                        </div>
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['noSerie']?>" id="noSerie" placeholder="No. Serie" aria-label="No. Serie" aria-describedby="basic-addon1" required>
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
                
                <div class="row" id="aplicaciones">
                    <?php if(isset($aplicaciones)): ?>
                        <?php foreach($aplicaciones as $aplicacion):?>
                        <div class="col-6 col-md-3">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" id="Aplicacion<?php echo $aplicacion['idAplicacion']?>">
                                <input type="text" class="form-control" value="<?php echo $aplicacion['nombre']?>" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </span>
                                </div>
                                
                                </input>
                            </div>
                        </div>
                        <?php endforeach?>
                    <?php endif?>
                </div>
            </div>
        </form>
    
    </div>
</div>