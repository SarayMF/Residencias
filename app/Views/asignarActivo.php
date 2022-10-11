<div class="main-container center">
    <div class="form-container">

        <center><h4>Asignar activo</h4></center>
        <hr>
            <?php if(isset($activo)):?>
            <label>
                Numero de activo:
                <div class="input-group mb-3">
                <input type="text" class="form-control" id="noActivo" value="<?php echo $activo['noActivo']?>" aria-label="No de activo" aria-describedby="basic-addon1" readonly>
                </div>
            <?php else:?>
                <label>
                Buscar activo
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="noActivo" id="noActivo" placeholder="# de activo" aria-label="# de activo" aria-describedby="basic-addon1">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <button type="button" class="close" id="buscarActivo">
                            <span aria-hidden="true"><i class="fas fa-search"></i></span>
                            </button>
                        </span>
                    </div>
                </div>
            <?php endif?>
        </label>

        <?php if(!isset($activo)):?>
            <div class="row">
                <div class="col-6 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-copyright"></i></span>
                        </div>
                        <input type="text" class="form-control" value="" id="marca" placeholder="Marca" aria-label="marca" aria-describedby="basic-addon1" readonly>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Modelo</span>
                        </div>
                        <input type="text" class="form-control" value="" id="modelo" placeholder="Modelo" aria-label="modelo" aria-describedby="basic-addon1" readonly>
                    </div>
                </div>
            </div>
        <?php endif?>

        <form id="formularioAsignacion" method="post">
            <div class="row">
            <div class="col-12 col-md-5">
                <?php if(isset($usuario)):?>
                    <label for="curp">
                        Usuario:
                    </label>
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" name="curp" id="curp" value="<?php echo $usuario['curp']?>" aria-label="curp" aria-describedby="basic-addon1" readonly>
                    </div>
                <?php else:?>
                    <label for="curp">
                        Buscar usuario:
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="curp" id="curp" placeholder="CURP" aria-label="curp" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <button type="button" class="close" id="buscar">
                                <span aria-hidden="true"><i class="fas fa-search"></i></span>
                                </button>
                            </span>
                        </div>
                    </div>
                <?php endif?>
            </div>
            </div>
            <center>
                <div id="loader" class=""></div>
            </center>
            <input type="hidden" id="idUsuario" value="<?php if(isset($usuario)) echo $usuario["idUsuario"]?>">
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Nombre completo</span>
                        </div>
                        <input type="text" id="nombre" value="<?php if(isset($usuario)) echo $usuario['nombre']?>" class="form-control" readonly>
                        <input type="text" id="apellidoP" value="<?php if(isset($usuario)) echo $usuario['apellidoP']?>" class="form-control" readonly>
                        <input type="text" id="apellidoM" value="<?php if(isset($usuario))echo $usuario['apellidoM']?>" class="form-control" readonly>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 ">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Observaciones</span>
                        </div>
                        <textarea class="form-control" id="observaciones" aria-label="With textarea"></textarea>
                    </div>
                </div>
            </div>

            <div class="float-right">
                <button class="btn btn-primary" type="submit" id="guardar" disabled>Guardar</button>
                <a class="btn btn-danger" href="<?php if(!isset($usuario)){echo base_url('/Entrada de activos'); }else {echo base_url('/Registro de mis activos');} ?>" role="button">Cancelar</a>
            </div>
        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<?php if(isset($usuario)):?>
    <script src="<?php echo base_url('resources/js/asignacionUsuario.js');?>" ></script>
<?php elseif(isset($activo)):?>
    <script src="<?php echo base_url('resources/js/asignacionActivo.js');?>" ></script>
<?php endif?>