var tableFamilias;

document.addEventListener('DOMContentLoaded', function () {

    tableFamilias = $('#tableFamilias').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Familias/getFamilias",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_familia" },
            { "data": "nombre" },
            { "data": "diametro" },
            { "data": "forma" },
            { "data": "peso" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
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
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formFamilia = document.querySelector("#formFamilia");
    formFamilia.onsubmit = function (e) {
        e.preventDefault();

        var intIdFamilia = document.querySelector('#idFamilia').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var decDiametro = document.querySelector('#decDiametro').value;
        var strForma = document.querySelector('#txtForma').value;
        var decPeso = document.querySelector('#decPeso').value;
        var txtCanto = document.querySelector('#txtCanto').value;
        var txtComposicion = document.querySelector('#txtComposicion').value;

        if (strNombre == '' || decDiametro == '' || strForma == '' || decPeso == '' || txtCanto == '' || txtComposicion == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }
        decDiametro = parseFloat(decDiametro).toFixed(3);
        decPeso = parseFloat(decPeso).toFixed(3);

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Familias/setFamilia';
        var formData = new FormData(formFamilia);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormFamilia').modal("hide");
                    formFamilia.reset();
                    swal("Familias", objData.msg, "success");
                    tableFamilias.api().ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }

}, false);

$('#tableFamilias').DataTable();


function fntViewFamilia(id_familia) {
    var idFamilia = id_familia;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Familias/getFamilia/' + idFamilia;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celDiametro").innerHTML = objData.data.diametro+' cm.';
                document.querySelector("#celForma").innerHTML = objData.data.forma;
                document.querySelector("#celPeso").innerHTML = objData.data.peso+' gramos';
                document.querySelector("#celCanto").innerHTML = objData.data.canto;
                document.querySelector("#celComposicion").innerHTML = objData.data.composicion;
                $('#modalViewFamilia').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditFamilia(id_familia) {
    document.querySelector('#titleModal').innerHTML = "Actualizar familia de monedas";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idFamilia = id_familia;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Familias/getFamilia/' + idFamilia;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idFamilia").value = objData.data.id_familia;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#decDiametro").value = objData.data.diametro;
                document.querySelector("#txtForma").value = objData.data.forma;
                document.querySelector("#decPeso").value = objData.data.peso;
                document.querySelector("#txtCanto").value = objData.data.canto;
                document.querySelector("#txtComposicion").value = objData.data.composicion;
                $('#modalFormFamilia').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
    $('#modalFormFamilia').modal('show');    
}

function fntDelFamilia(id_familia) {
    var idFamilia = id_familia;
    swal({
        title: "Eliminar familia",
        text: "¿Desea eliminar la familia de monedas?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Familias/delFamilia';
            var strData = "idFamilia=" + idFamilia;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableFamilias.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}


function openModal() {
    document.querySelector('#idFamilia').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#titleModal').innerHTML = "Nueva familia de monedas";
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector("#formFamilia").reset();

    $("#modalFormFamilia").modal("show");
}