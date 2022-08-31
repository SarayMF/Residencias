<div class="main-container center">
    <div class="form-container permisos">
        <center><h3>Asignacion de permisos a usuarios</h3></center>
        <br>
        <center>
            <span>
                Curp: <?php echo $datosUsuario["curp"]?> <br>
                Usuario: <?php echo $datosUsuario["nombre"]." ".$datosUsuario["apellidoP"]." ".$datosUsuario["apellidoM"]?>
            </span>
        </center>

        <div class="lista-permisos">
            <?php foreach($listaPermisos as $p):?>
                <?php foreach ($datosPermisoUsuario as $pu):?>
                    <?php if($p["idPermiso"] == $pu["idPermiso"]):?>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                        <label class="custom-control-label" for="customCheck1"><?php echo $p["nombre"]?></label>
                        </div>
                        <?php break?>
                    <?php endif?>
                <?php endforeach?>
                
            <?php endforeach?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
