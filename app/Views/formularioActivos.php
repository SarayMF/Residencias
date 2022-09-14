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
                        <input type="text" class="form-control" value="<?php if(isset($activo)) echo $activo['marca']?>" id="marca" placeholder="hp, dell, lenovo, etc." aria-label="marca" aria-describedby="basic-addon1" required>
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
                <pre><?php var_dump($aplicaciones)?></pre>
            </div>
        </form>
    
    </div>
</div>