<div class="main-container center">
    <div class="form-container entrada">

    <center>
        <h4>Entrada de activos</h4>
    </center>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="Activos-tab" data-toggle="tab" href="#Activos" role="tab" aria-controls="Activos" aria-selected="true">Activos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="Accesorios-tab" data-toggle="tab" href="#Accesorios" role="tab" aria-controls="Accesorios" aria-selected="false">Accesorios</a>
    </li>
    </ul>
    <br>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="Activos" role="tabpanel" aria-labelledby="Activos-tab">
            <div class="float-right d-flex">
              
                <div class="input-group mb-3 d-contents">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="search" class="form-control" id="buscar" placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
                </div>
                <div style="width:5px"></div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#registroModal">Agregar</button>
            </div>

            <br><br>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col"># Activo</th>
                    <th scope="col"># Serie</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Fecha de alta</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Asignar</th>
                    </tr>
                </thead>
                <tbody id="listaActivos">

                </tbody>
            </table>
            <center>
                <div id="loader" class=""></div>
            </center>
            <nav id="paginacion" aria-label="Page navigation example">
                <ul class="pagination justify-content-end pagination-sm">
                    
                </ul>
            </nav>

            <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registroModalLabel">Nuevo activo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="Accesorios" role="tabpanel" aria-labelledby="Accesorios-tab">Accesorios</div>
     </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
