<div class="main-container center">
    <div class="form-container">

        <center><h4>Asignar activo</h4></center>
        <hr>
        <label>
            Numero de activo:
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="# de activo" aria-label="No de activo" aria-describedby="basic-addon1" readonly>
            </div>
        </label>

        <form id="formularioActivo" method="post">
            <div class="row">
            <div class="col-12 col-md-5">
                <label for="curp">
                    Buscar usuario:
                </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="curp" placeholder="CURP" aria-label="curp" aria-describedby="basic-addon1">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <button type="button" class="close" id="buscar">
                            <span aria-hidden="true"><i class="fas fa-search"></i></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            </div>
            <center>
                <div id="loader" class=""></div>
            </center>
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Nombre completo</span>
                        </div>
                        <input type="text" class="form-control" readonly>
                        <input type="text" class="form-control" readonly>
                        <input type="text" class="form-control" readonly>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 ">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Observaciones</span>
                        </div>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                </div>
            </div>

            <div class="float-right">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn btn-danger" href="<?php echo base_url('/Entrada de activos')?>" role="button">Cancelar</a>
            </div>
        </form>

    </div>
</div>