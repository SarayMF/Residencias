    <div class="main-container center">
        <div class="form-container">
            <form action="" method="post">
                <div class="top-container center">
                    <img src="<?php echo base_url('resources/img/logo-gto.png')?>" alt="logo de juventudEsGto">
                </div>
                <p class="text-muted center">Inicia sesión con tu cuenta de JuventudEsGto</p>

                <?php if(isset($success) && $success == 1):?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ¡Te hemos enviado un correo para la creacion de tu contraseña!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif;?>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="email" class="form-control" name="correo" placeholder="Correo" aria-label="correo" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="contraseña" placeholder="Contraseña" aria-label="contraseña" aria-describedby="basic-addon1">
                </div>

                <div>
                    <p class="text-muted">¿No tienes cuenta? <a href="<?php echo base_url('register')?>">Registrate aqui</a></p>
                </div>

                <div class="center">
                    <button type="submit" class="btn btn-primary center">Acceder</button>
                </div>

            </form>
        </div>
    </div>