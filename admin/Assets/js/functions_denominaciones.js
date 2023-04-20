var tableDenominaciones;

document.addEventListener('DOMContentLoaded', function () {
    tableDenominaciones = $('#tableDenominaciones').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Denominaciones/getDenominaciones",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_denominacion" },
            { "data": "valor" },
            { "data": "nombre" },
            { "data": "options" }
        ],
        "dom": 'Bfrtip',
        'buttons': [
            {
                'extend': 'copyHtml5',
                'text': '<i class="far fa-copy"></i> Copiar',
                'titleAttr': 'Copiar',
                'className': 'btn btn-secondary'
            }, {
                'extend': 'excelHtml5',
                'text': '<i class="fas fa-file-excel"></i> Excel',
                'titleAttr': 'Exportar a Excel',
                'className': 'btn btn-success'
            }, {
                'extend': 'pdfHtml5',
                'text': '<i class="fas fa-file-pdf"></i> PDF',
                'titleAttr': 'Exportar a PDF',
                'className': 'btn btn-danger'
            }, {
                'extend': 'csvHtml5',
                'text': '<i class="fas fa-file-csv"></i> CSV',
                'titleAttr': 'Exportar a CSV',
                'className': 'btn btn-info'
            }
        ],
        "responsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formDenominacion = document.querySelector("#formDenominacion");
    formDenominacion.onsubmit = function (e) {
        e.preventDefault();

        var intIdDenominacion = document.querySelector('#idDenominacion').value;
        var intValor = document.querySelector('#intValor').value;
        var intIdFamilia = document.querySelector('#listDenominacionid').value;

        if (intIdFamilia == '' || intValor == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        intValor = parseInt(intValor);

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Denominaciones/setDenominacion';
        var formData = new FormData(formDenominacion);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormDenominacion').modal("hide");
                    formDenominacion.reset();
                    swal("Denominaciones", objData.msg, "success");
                    tableDenominaciones.api().ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }


}, false);

$('#tableDenominaciones').DataTable();

window.addEventListener('load', function () {
    fntFamiliasDenominacion();
}, false);

function fntFamiliasDenominacion() {
    var ajaxUrl = base_url + '/Familias/getSelectFamilias';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listDenominacionid').innerHTML = request.responseText;
            //document.querySelector('#listDenominacionid').value = 1;
            $('#listDenominacionid').selectpicker('render');
        }
    }
}

function fntViewDenominacion(id_denominacion) {
    var idDenominacion = id_denominacion;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Denominaciones/getDenominacion/' + idDenominacion;
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#celId").innerHTML = objData.data.id_denominacion;
                document.querySelector("#celValor").innerHTML = objData.data.valor+'.00 pesos mxn';
                document.querySelector("#celNombreFamilia").innerHTML = objData.data.nombre;
                document.querySelector("#celDiametro").innerHTML = objData.data.diametro+' cm.';
                document.querySelector("#celForma").innerHTML = objData.data.forma;
                document.querySelector("#celPeso").innerHTML = objData.data.peso+' gramos';
                document.querySelector("#celCanto").innerHTML = objData.data.canto;
                document.querySelector("#celComposicion").innerHTML = objData.data.composicion;

                $('#modalViewDenominacion').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}


function fntEditDenominacion(id_denominacion) {
    document.querySelector('#titleModal').innerHTML = "Actualizar denominación";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idDenominacion = id_denominacion;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Denominaciones/getDenominacion/' + idDenominacion;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idDenominacion").value = objData.data.id_denominacion;
                document.querySelector("#intValor").value = objData.data.valor;
                document.querySelector("#listDenominacionid").value = objData.data.id_denominacion;
                $('#listDenominacionid').selectpicker('render');
                $('#modalFormDenominacion').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntDelDenominacion(id_denominacion) {
    var idDenominacion = id_denominacion;
    swal({
        title: "Eliminar denominación",
        text: "¿Desea eliminar la denominación?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Denominaciones/delDenominacion/';
            var strData = "idDenominacion=" + idDenominacion;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableDenominaciones.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}


function openModal() {
    document.querySelector('#idDenominacion').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva denominación";
    document.querySelector("#formDenominacion").reset();
    $('#modalFormDenominacion').modal('show');
}