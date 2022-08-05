<div class="main-container center">
        <div class="form-container">
            <form action="<?php echo base_url("registrarContraseña")?>" id="formulario-cont" method="post">
                <div class="top-container center">
                    <img src="<?php echo base_url('resources/img/logo-gto.png')?>" alt="logo de juventudEsGto">
                </div>
                <p class="text-muted center">Completa tu registro capturando una contraseña</p>

                <input type="text" name="id" value="<?= $datos->id ?>">
                <input type="text" name="token" id="">
                
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" id="password1" class="form-control" name="password1" placeholder="Contraseña" aria-label="password" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" id="password2" class="form-control" name="password2" placeholder="Confirmar contraseña" aria-label="password2" aria-describedby="basic-addon1">
                </div>

                <?php if (! empty($validation)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="error-form-validation"><?= $validation->listErrors() ?></p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                
                <div class="center">
                    <button type="submit" class="btn btn-primary center">Completar registro</button>
                </div>

            </form>
        </div>
    </div>