    <div class="main-container center">
        <div class="form-container login">
            <form method="post" id="formLogin">
                <div class="top-container center">
                    <img src="<?php echo base_url('resources/img/logo-gto.png')?>" alt="logo de juventudEsGto">
                </div>
                <p class="text-muted center">Inicia sesión con tu cuenta de JuventudEsGto</p>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" aria-label="correo" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña" aria-label="contraseña" aria-describedby="basic-addon1">
                </div>

                <div>
                    <p class="text-muted">¿No tienes cuenta? <a href="<?php echo base_url('registro')?>">Registrate aqui</a></p>
                </div>

                <div id="alerta">

                </div>
                
                <div class="center">
                    <button type="submit" class="btn btn-primary center">Acceder</button>
                </div>

            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?php echo base_url('resources/js/attemptLogin.js');?>"></script>