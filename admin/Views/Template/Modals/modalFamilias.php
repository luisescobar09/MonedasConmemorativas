<!-- Modal -->
<div class="modal fade" id="modalFormFamilia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Familia de monedas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formFamilia" name="formFamilia">
                            <input type="hidden" id="idFamilia" name="idFamilia" value="">
                            <p class="text-danger">*<small> Todos los campos son obligatorios.</small></p>
                            <div class="form-group">
                                <label class="control-label" for="txtNombre">Nombre</label>
                                <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre de la familia" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="decDiametro">Diámetro</label>
                                    <input class="form-control" type="number" step="any" id="decDiametro" name="decDiametro" placeholder="Diámetro de la moneda" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="decPeso">Peso</label>
                                    <input class="form-control" type="number" step="any" id="decPeso" name="decPeso" placeholder="Peso de la moneda" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label class="control-label" for="txtForma">Forma</label>
                                    <input class="form-control" id="txtForma" name="txtForma" placeholder="Forma de la moneda" maxlength="15" required>
                                </div>                                
                                <div class="col-md-6">
                                    <label class="control-label" for="txtCanto">Canto</label>
                                    <input class="form-control" id="txtCanto" name="txtCanto" placeholder="Canto de la moneda" maxlength="30" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="control-label" for="txtComposicion">Composición</label>
                                <textarea class="form-control" id="txtComposicion" name="txtComposicion" rows="6" placeholder="Composición de la moneda" required></textarea>
                            </div>
                            <div class="tile-footer">
                                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewFamilia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos familia de monedas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody class="text-center">
                        <tr>
                            <td>Nombre</td>
                            <td id="celNombre"></td>
                        </tr>
                        <tr>
                            <td>Diámetro</td>
                            <td id="celDiametro"></td>
                        </tr>
                        <tr>
                            <td>Forma</td>
                            <td id="celForma"></td>
                        </tr>
                        <tr>
                            <td>Peso</td>
                            <td id="celPeso"></td>
                        </tr>
                        <tr>
                            <td>Canto</td>
                            <td id="celCanto"></td>
                        </tr>
                        <tr>
                            <td>Composición</td>
                            <td id="celComposicion"></td>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>