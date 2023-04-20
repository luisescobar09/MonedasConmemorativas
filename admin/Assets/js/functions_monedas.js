var tableMonedas;

document.addEventListener('DOMContentLoaded', function () {
    tableMonedas = $('#tableMonedas').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Monedas/getMonedas",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_moneda" },
            { "data": "nombre" },
            { "data": "valor" },
            { "data": "familia" },
            { "data": "presentacion" },
            { "data": "decreto" },
            { "data": "fecha_circulacion" },
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
        "responsive": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formMoneda = document.querySelector("#formMoneda");
    formMoneda.onsubmit = function (e) {
        e.preventDefault();

        var intIdMoneda = document.querySelector('#idMoneda').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var listDenominacionid = document.querySelector('#listDenominacionid').value;
        var txtDescripcion = document.querySelector('#txtDescripcion').value;
        var txtPresentacion = document.querySelector('#txtPresentacion').value;
        var txtDecreto = document.querySelector('#txtDecreto').value;
        var fechaCirculacion = document.querySelector('#fechaCirculacion').value;
        var uploadFoto = document.querySelector('#img1').value;

        if(strNombre != '' || listDenominacionid != '' || txtDescripcion != '' || txtPresentacion
            != '' || txtDecreto != '' || fechaCirculacion != '' || uploadFoto != '') {
            
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Monedas/setMoneda';
            var formData = new FormData(formMoneda);
            request.open("POST", ajaxUrl, true);
            request.send(formData);

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormMoneda').modal("hide");
                        formMoneda.reset();
                        swal("Moneda conmemorativa", objData.msg, "success");
                        tableMonedas.api().ajax.reload();
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
            }
            
        }
    }

}, false);

window.addEventListener('load', function () {
    fntInputFile();
    fntDenominacionesMonedas();
}, false);

function fntViewMoneda(id_moneda) {
    var idMoneda = id_moneda;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Monedas/getMoneda/' + idMoneda;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if(request.readyState == 4 && request.status == 200 ){
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celDenominacion").innerHTML = objData.data.valor;
                document.querySelector("#celFamilia").innerHTML = objData.data.familia;
                document.querySelector("#celPresentacion").innerHTML = objData.data.presentacion;
                document.querySelector("#celDecreto").innerHTML = objData.data.decreto;
                document.querySelector("#celFechaCirculacion").innerHTML = objData.data.fecha_circulacion;
                document.querySelector("#celDiametro").innerHTML = objData.data.diametro+' cm.';
                document.querySelector("#celForma").innerHTML = objData.data.forma;
                document.querySelector("#celPeso").innerHTML = objData.data.peso+' gramos';
                document.querySelector("#celCanto").innerHTML = objData.data.canto;
                document.querySelector("#celComposicion").innerHTML = objData.data.composicion;
                document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;
                document.querySelector("#celImagen").innerHTML = '<img src="'+base_url+'/Assets/images/uploads/'+objData.data.imagen+'">';
                $('#modalViewMoneda').modal('show');
            }
            else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditMoneda(id_moneda) {
    document.querySelector('#titleModal').innerHTML = "Actualizar familia de monedas";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";
}

function fntDenominacionesMonedas() {
    var ajaxUrl = base_url + '/Denominaciones/getSelectDenominaciones';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listDenominacionid').innerHTML = request.responseText;
            //document.querySelector('#listDenominacionid').value = 2;
            $('#listDenominacionid').selectpicker('render');
        }
    }
}

function fntInputFile() {
    let inputUploadFile = document.querySelector('#img1');
    inputUploadFile.addEventListener('change', function () {
        let idMoneda = document.querySelector('#idMoneda').value;
        let uploadFoto = document.querySelector('#img1').value;
        let fileUpload = document.querySelector('#img1').files;
        let prevImg = document.querySelector('.prevImage');
        let nav = window.URL || window.webkitURL;
        if(uploadFoto != ''){
            let type = fileUpload[0].type;
            let name = fileUpload[0].name;
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                prevImg.innerHTML = '<b>Archivo no valido</b>';
                document.querySelector('#img1').value = '';
                return false;
            }else{
                prevImg.innerHTML = '';
                let objUrl = nav.createObjectURL(this.files[0]);
                prevImg.innerHTML = '<img src="'+objUrl+'">';
              
                prevImg.innerHTML = `<img src="${objUrl}">`;
                document.querySelector('.btnDeleteImage').setAttribute("imgname", objData.imgname);
                document.querySelector('.btnUploadFile').classList.add('notBlock');
                document.querySelector('.btnDeleteImage').classList.remove('notBlock');    
            }
            
        }
    });
}

function openModal() {
    document.querySelector('#idMoneda').value = '';
    document.querySelector('.modal-header').classList.replace('headerUpdate', 'headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info', 'btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector('#titleModal').innerHTML = 'Nueva moneda conmemorativa';
    document.querySelector('#img1').value = '';
    document.querySelector('#formMoneda').reset();
    $('#modalFormMoneda').modal('show');
}