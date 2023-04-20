var tableUsuarios;
document.addEventListener('DOMContentLoaded', function () {

    tableUsuarios = $('#tableUsuarios').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_usuario" },
            { "data": "nombre_completo" },
            { "data": "email" },
            { "data": "nombre_rol" },
            { "data": "status" },
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



    var formUsuario = document.querySelector('#formUsuario');
    formUsuario.onsubmit = function (e) {
        e.preventDefault();
        var intIdUsuario = document.querySelector('#idUsuario').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intTipoUsuario = document.querySelector('#listRolid').value;
        var strPassword = document.querySelector('#txtPassword').value;

        if (strNombre == '' || strEmail == '' || intTipoUsuario == '') {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (var i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                swal("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Usuarios/setUsuario';
        var formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormUsuario').modal("hide");
                    formUsuario.reset();
                    swal("Usuarios", objData.msg, "success");
                    tableUsuarios.ajax.reload();
                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        }
    }

}, false);
$('#tableUsuarios').DataTable();

window.addEventListener('mouseup', function () {
    /*fntViewUsuario();
    fntEditUsuario();
    fntDelUsuario();*/
}, false);

window.addEventListener('load', function () {
    fntRolesUsuario();
}, false);

function fntRolesUsuario() {
    var ajaxUrl = base_url + '/Roles/getSelectRoles';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listRolid').innerHTML = request.responseText;
            document.querySelector('#listRolid').value = 1;
            $('#listRolid').selectpicker('render');
        }
    }
}

function fntViewUsuario(id_usuario) {
    var id_usuario = id_usuario;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + id_usuario;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                var estadoUsuario = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celNombre").innerHTML = objData.data.nombre_completo;
                document.querySelector("#celEmail").innerHTML = objData.data.email;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombre_rol;
                document.querySelector("#celStatus").innerHTML = estadoUsuario;
                $('#modalViewUsuario').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }

}

function fntEditUsuario(id_usuario) {
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var id_usuario = id_usuario;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + id_usuario;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#idUsuario").value = objData.data.id_usuario;
                document.querySelector("#txtNombre").value = objData.data.nombre_completo;
                document.querySelector("#txtEmail").value = objData.data.email;
                document.querySelector("#listRolid").value = objData.data.id_rol;
                $('#listRolid').selectpicker('refresh');
                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');

            } else {
                swal("Error", objData.msg, "error");
            }
        }
        $('#modalFormUsuario').modal('show');
    }
}

function fntDelUsuario(id_usuario) {
    var idUsuario = id_usuario;
    swal({
        title: "Eliminar Usuario",
        text: "¿Desea eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Usuarios/delUsuario';
            var strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableUsuarios.ajax.reload(function () {
                            fntRolesUsuario();
                        });
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    }
        , false);
}

function openModal() {
    document.querySelector('#idUsuario').value = '';
    document.querySelector('.modal-header').classList.replace('headerUpdate', 'headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info', 'btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector('#titleModal').innerHTML = 'Nuevo Usuario';
    document.querySelector('#formUsuario').reset();
    $('#modalFormUsuario').modal('show');
}