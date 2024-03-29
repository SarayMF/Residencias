<div class="main-container center">
    <div class="form-container login">
        <div class="top-container center">
            <img src="<?php echo base_url('resources/img/logo-gto.png')?>" alt="logo de juventudEsGto">
        </div>
        <br>
        <form action="<?php echo base_url('registro')?>" id="formulario" method="post">
            <div class="grid-form">

                <div class="curp" id="grupo_curp">
                    <div class="input-group mb-3" >
                        <div class="input-group-prepend">
                            <span class="span input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="input form-control" name="curp" value="<?= set_value('curp') ?>" id="curp" placeholder="Curp" aria-label="curp" aria-describedby="basic-addon1" required><br>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="buscar"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <p class="form-input-err">Curp invalido</p>
                </div>

                <div class="input-group mb-3 nombres">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nombre" value="<?= set_value('nombre') ?>" id="nombre" placeholder="Nombres" aria-label="nombre" aria-describedby="basic-addon1" required readonly>
                </div>

                <div class="input-group mb-3 apellidoP">
                    <input type="text" class="form-control" name="apellidoP" value="<?= set_value('apellidoP') ?>" id="apellidoP" placeholder="Apellido paterno" aria-label="apellidoPaterno" aria-describedby="basic-addon1" readonly>
                </div>

                <div class="input-group mb-3 apellidoM">
                    <input type="text" class="form-control" name="apellidoM" value="<?= set_value('apellidoM') ?>" id="apellidoM" placeholder="Apellido materno" aria-label="apellidoMaterno" aria-describedby="basic-addon1" readonly>
                </div>

                <div class="input-group mb-3 area">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="area"><i class="fa fa-briefcase"></i></label>
                    </div>
                    <select class="custom-select" name="area" id="area" required>
                        <option disabled="disabled" selected>Selecciona area</option>
                        <?php foreach($areas as $a):?>
                            <option value="<?php echo $a['idArea']?>"><?php echo $a['area']?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="input-group mb-3 puesto">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="puesto"><i class="fa fa-building"></i></label>
                    </div>
                    <select class="custom-select" name="puesto" id="puesto" required>
                        <option disabled="disabled" selected>Selecciona puesto</option>
                    </select>
                </div>

                <div class="correo" id="grupo_correo">
                    <div class="input-group mb-3 correo">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="email" class="form-control input" name="correo" value="<?= set_value('correo') ?>" id="correo" placeholder="Correo" aria-label="correo" aria-describedby="basic-addon1" required>
                    </div>
                    <p class="form-input-err">Debes utilizar un correo valido y debe ser tu correo institucional</p>
                </div>
            </div>

            <div>
                <p class="text-muted">¿Ya tienes una cuenta? <a href="<?php echo base_url()?>">Ingresa aqui</a></p>
            </div>

            <center>
                <div id="loader" class=""></div>
            </center>
            <div id="error">
                
            </div>
            <br>
            <div class="center">
                <button type="submit" id="submit" class="btn btn-primary center save-data">Registrarme</button>
            </div>
        </form>
    </div>
</div>


<script src="<?php echo base_url('resources/js/validacionRegistro.js');?>" ></script>
<script src="<?php echo base_url('resources/js/registroUsuario.js');?>" ></script>
