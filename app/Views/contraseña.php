<div class="main-container center">
        <div class="form-container">
            <form action="<?php echo base_url("registrarContraseña")?>" id="formulario" method="post">
                <div class="top-container center">
                    <img src="<?php echo base_url('resources/img/logo-gto.png')?>" alt="logo de juventudEsGto">
                </div>
                <p class="text-muted center">Completa tu registro capturando una contraseña</p>

                <div id="grupo_password1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" id="password1" class="form-control" name="password1" placeholder="Contraseña" aria-label="password" aria-describedby="basic-addon1">
                    </div>
                    <div class="form-input-err">
                        <ul>
                            <li>8 - 20 caracteres de largo</li>
                            <li>Minimo una mayuscula</li>
                            <li>Minimo una minuscula</li>
                            <li>Minimo un digito</li>
                            <li>Mimino un caracter especial</li>
                        </ul>
                    </div>
                </div>

                <div id="grupo_password2">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" id="password2" class="form-control" name="password2" placeholder="Confirmar contraseña" aria-label="password2" aria-describedby="basic-addon1">
                    </div>
                    <p class="form-input-err">
                        Las contraseñas deben coincidir
                    </p>
                </div>

                <div class="center">
                    <button type="submit" class="btn btn-primary center">Completar registro</button>
                </div>

            </form>
        </div>
    </div>