<div class="main-container center">
    <div class="form-container permisos">
        <center><h3 class="titulo">Asignacion de permisos a usuarios</h3></center>
        <br>
        <center>
            <span>
                Curp: <?php echo $datosUsuario["curp"]?> <br>
                Usuario: <?php echo $datosUsuario["nombre"]." ".$datosUsuario["apellidoP"]." ".$datosUsuario["apellidoM"]?>
            </span>
        </center>

        <br>
        
        
        <form id="formulario">
            <div class= "center">
                <div class="lista-permisos">
                    <h6>Lista de permisos:</h6>
                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $datosUsuario["idUsuario"]?>">
                    <?php foreach($listaPermisos as $p):?>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input"  value="<?php echo $p["idPermiso"]?>" id="<?php echo $p["idPermiso"]?>" <?=(in_array($p['idPermiso'], array_column($datosPermisoUsuario, 'idPermiso'))?"checked":"")?>>
                        <label class="custom-control-label" for="<?php echo $p["idPermiso"]?>"><?php echo $p["nombre"]?></label>
                        </div>
                    <?php endforeach?>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Guardar cambios<div id="loader" class=""></div></button>
                        <a class="btn btn-danger" href="<?php echo base_url("Otorgar permisos")?>" role="button">Cancelar</a>
                    </div>
                </div>
            </div>
        </form >

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script  src="<?php echo base_url('resources/js/guardarPermisos.js');?>" ></script>
