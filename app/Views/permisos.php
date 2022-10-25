<div class="main-container center">
    <div class="body-container permisos">
        <center><h3 class="titulo">Asignacion de permisos a usuarios</h3></center>
        <br><br>
        <div class="permisos-container">
            
            <div class="form-group justify-content-end">
                <div class="form-inline my-2 my-lg-0">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nombre de usuario" id="buscar" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope='col'>CURP</th>
                            <th scope='col'>Nombre</th>
                            <th scope='col'>Apellido paterno</th>
                            <th scope='col'>Apellido materno</th>
                            <th scope='col'>Editar permisos</th>
                        </tr>
                    </thead>
                    <tbody id="listaUsuarios">
                        
                    </tbody>
                </table>
                <center>
                    <div id="loader" class=""></div>
                </center>
                <nav id="paginacion" aria-label="Page navigation example">
                    <ul class="pagination justify-content-end pagination-sm">
                        
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script  src="<?php echo base_url('resources/js/mostrarUsuarios.js');?>" ></script>