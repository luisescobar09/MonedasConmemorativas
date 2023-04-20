<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" name="formUsuario" class="form-horizontal">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="">
                    <p class="text-danger">*<small> Todos los campos son obligatorios.</small></p>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="txtNombre">Nombre completo</label>
                            <input class="form-control valid validText" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del usuario" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="txtEmail">Correo electrónico</label>
                            <input class="form-control valid validEmail" id="txtEmail" name="txtEmail" type="email" placeholder="Email del usuario" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="txtPassword">Contraseña</label>
                            <input class="form-control" id="txtPassword" name="txtPassword" type="password" placeholder="Contraseña del usuario">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listRolid">Tipo de usuario</label>
                            <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listStatus">Estado</label>
                            <select class="form-control selectpicker" id="listStatus" name="listStatus" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="tile-footer">
                            <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Nombre completo</td>
                            <td id="celNombre"></td>
                        </tr>
                        <tr>
                            <td>Correo electrónico</td>
                            <td id="celEmail"></td>
                        </tr>
                        <tr>
                            <td>Tipo de usuario</td>
                            <td id="celTipoUsuario"></td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td id="celStatus"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>