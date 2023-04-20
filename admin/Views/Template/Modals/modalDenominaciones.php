<!-- Modal -->
<div class="modal fade" id="modalFormDenominacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva denominación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDenominacion" name="formDenominacion" class="form-horizontal">
                    <input type="hidden" id="idDenominacion" name="idDenominacion" value="">
                    <p class="text-danger">*<small> Todos los campos son obligatorios.</small></p>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="intValor">Valor monetario</label>
                            <input class="form-control valid validNumber" id="intValor" name="intValor" type="number" placeholder="Valor monetario para la denominación" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="listDenominacionid">Familia a la que pertenece</label>
                            <select class="form-control" data-live-search="true" id="listDenominacionid" name="listDenominacionid" aria-placeholder="Seleccione" required>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        
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


<div class="modal fade" id="modalViewDenominacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="titleModal">Datos de la denominación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody class="text-center">
                        <tr>
                            <th>ID</th>
                            <td id="celId"></td>
                        </tr>
                        <tr>
                            <th>Valor monetario</th>
                            <td id="celValor"></td>
                        </tr>
                        <tr>
                            <th>Familia a la que pertenece</th>
                            <th id="celNombreFamilia"></th>
                        </tr>
                        <tr>
                            <th>Diámetro</th>
                            <td id="celDiametro"></td>
                        </tr>
                        <tr>
                            <th>Forma</th>
                            <td id="celForma"></td>
                        </tr>
                        <tr>
                            <th>Peso</th>
                            <td id="celPeso"></td>
                        </tr>
                        <tr>
                            <th>Canto</th>
                            <td id="celCanto"></td>
                        </tr>
                        <tr>
                            <th>Composición</th>
                            <td id="celComposicion"></td>
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