<div class="modal fade" id="modalFormMoneda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva moneda conmemorativa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formMoneda" name="formMoneda" class="form-horizontal">
                    <input type="hidden" id="idMoneda" name="idMoneda" value="">
                    <p class="text-danger">*<small> Todos los campos son obligatorios.</small></p>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="txtNombre">Nombre</label>
                            <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre de la moneda" maxlength="200" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listDenominacionid">Denominación a la que pertenece</label>
                            <select class="form-control" data-live-search="true" id="listDenominacionid" name="listDenominacionid" aria-placeholder="Seleccione" required>
                                <option value=""selected disabled>
                                    Seleccione
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label" for="txtDescripcion">Descripción</label>
                            <textarea class="form-control" rows="6" id="txtDescripcion" name="txtDescripcion" type="text" placeholder="Descripción de la moneda" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="txtPresentacion">Presentación</label>
                            <input class="form-control" id="txtPresentacion" name="txtPresentacion" type="url" placeholder="https://example.com" pattern="https://.*" size="100" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="txtDecreto">Decreto</label>
                            <input class="form-control" id="txtDecreto" name="txtDecreto" type="url" placeholder="https://example.com" pattern="https://.*" size="100" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="fechaCirculacion">Fecha de circulación</label>
                            <input class="form-control" id="fechaCirculacion" name="fechaCirculacion" type="date" value="<?= date("Y-m-d"); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                        <span>Imagen</span>
                            <div id="containerImages">
                                <div id="div24">
                                    <div class="prevImage">
                                        <img class="loading" src="<?= media(); ?>/images/loading.svg" alt="Imagen a cargar">
                                    </div>
                                    <input type="file" name="photo" id="img1" class="inputUploadFile custom-file-input">
                                    <label for="img1" class="btnUploadFile"><i class="fas fa-upload"></i> Subir</label>
                                    <button type="button" class="btnDeleteImage" type="button" onclick="fntDelItem('div24');"><i class="fas fa-trash-alt"></i> Eliminar</button>
                                </div>
                            </div>
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


<div class="modal fade" id="modalViewMoneda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos:</h5>
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
                            <td>Denominación</td>
                            <td id="celDenominacion"></td>
                        </tr>
                        <tr>
                            <td>Familia a la que pertenece</td>
                            <td id="celFamilia"></td>
                        </tr>
                        <tr>
                            <td>Presentación</td>
                            <td id="celPresentacion"></td>
                        </tr>
                        <tr>
                            <td>Decreto</td>
                            <td id="celDecreto"></td>
                        </tr>
                        <tr>
                            <td>Fecha de circulacion</td>
                            <td id="celFechaCirculacion"></td>
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
                        </tr>
                        <tr>
                            <td>Descripción</td>
                            <td id="celDescripcion"></td>
                        </tr>
                        <tr>
                            <td>Imagen</td>
                            <td id="celImagen"></td>
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