<div class="main-container center">
    <div class="form-container">
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
                    </div>
                    <p class="form-input-err">Curp invalido</p>
                </div>

                <div class="input-group mb-3 nombres">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nombre" value="<?= set_value('nombre') ?>" id="nombre" placeholder="Nombres" aria-label="nombre" aria-describedby="basic-addon1" required>
                </div>

                <div class="input-group mb-3 apellidoP">
                    <input type="text" class="form-control" name="apellidoP" value="<?= set_value('apellidoP') ?>" id="apellidoP" placeholder="Apellido paterno" aria-label="apellidoPaterno" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3 apellidoM">
                    <input type="text" class="form-control" name="apellidoM" value="<?= set_value('apellidoM') ?>" id="apellidoM" placeholder="Apellido materno" aria-label="apellidoMaterno" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3 puesto">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="puesto"><i class="fa fa-building"></i></label>
                    </div>
                    <select class="custom-select" name="puesto" id="puesto" required>
                        <option disabled="disabled" value="" selected>Selecciona puesto</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="input-group mb-3 area">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="area"><i class="fa fa-briefcase"></i></label>
                    </div>
                    <select class="custom-select" name="area" id="area" required>
                        <option disabled="disabled" value="" selected>Selecciona area</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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

            <?php if (! empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php foreach ($errors as $field => $error): ?>
                        <p class="error-form-validation"><?= $error ?></p>
                    <?php endforeach ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <div class="center">
                <button type="submit" class="btn btn-primary center">Registrarme</button>
            </div>
        </form>
    </div>
</div>