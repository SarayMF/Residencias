<div class="main-container center">
    <div class="form-container permisos">
        <center><h4><?php echo $titulo?></h4></center>
        <br><br>
        <form id="formulario">
            <?php if(isset($accesorio)):?>
                <input type="hidden" id="idAccesorio" value="<?php echo $accesorio['idAccesorio']?>">
            <?php endif?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nombre</span>
                        </div>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php if(isset($accesorio)) echo $accesorio['nombre']?>" placeholder="Nombre del accesorio" aria-label="accesorio" aria-describedby="basic-addon1" required>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hashtag"></i></span>
                        </div>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" value="<?php if(isset($accesorio)) echo $accesorio['cantidad']?>" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div>
            
            <center>
                <div id="loader" class=""></div>
            </center>

            <div class="float-right">
                <button class="btn btn-primary" type="submit" id="guardar">Guardar</button>
                <a class="btn btn-danger" href="<?php echo base_url('/Entrada de activos')?>" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php if(isset($accesorio)):?>
    <script  src="<?php echo base_url('resources/js/editarAccesorio.js');?>" ></script>
<?php else:?>
    <script  src="<?php echo base_url('resources/js/guardarAccesorio.js');?>" ></script>
<?php endif?>