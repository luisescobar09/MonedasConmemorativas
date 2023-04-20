document.addEventListener('DOMContentLoaded', function () {
    getMonedas();
});
const BASE_URL1 = 'https://monedas-conmemorativas.herokuapp.com';

function getMonedas() {
    var datosMonedas;
    if (window.navigator.onLine) {
      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var ajaxUrl = BASE_URL1 + '/admin/pwa/getMonedas/';
      request.open("GET", ajaxUrl, true);
      request.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          var objData = JSON.parse(this.responseText);
          if (objData.status) {
            datosMonedas = objData.data;
            if (JSON.stringify(objData.data) != localStorage.getItem('coinsJSON')) {
              localStorage.setItem('coinsJSON', JSON.stringify(objData.data));
            }
            showMonedas(objData.data);
          }
        }
      }
      request.open("GET", ajaxUrl, true);
      request.send();
    }
    else {
      data = JSON.parse(localStorage.getItem('coinsJSON'));
      showMonedas(data);
    }  
  }
  setInterval(getMonedas, 10000);

  function showMonedas(data) {
    const container = document.querySelector('#container');
    let output = '';
    data.forEach(
      ({ id_moneda, nombre, presentacion, valor, familia, fecha_circulacion, imagen }) => {
        putImage(BASE_URL1+'/admin/Assets/images/uploads/'+imagen);
        output += `
            <div class="card-panel recipe white row">
              <img src="${BASE_URL1}/admin/Assets/images/uploads/${imagen}" alt="coin thumb">
              <div class="recipe-details">
                <div class="recipe-title">Nombre: ${nombre}</div>
                <div class="recipe-ingredients"><b>Fecha de circulación:</b> ${fecha_circulacion}</div>
                <div class="recipe-ingredients"><b>Denominación:</b> ${valor} pesos</div>
                <div class="recipe-ingredients"><b>Familia a la que pertenece:</b> ${familia}</div>
                <div class="recipe-ingredients"><b>Presentación: ${presentacion}</b></div>
              </div>
              <div class="recipe-delete">
                <i class="material-icons mpopupLink" id="mpopupLink" data-value="${id_moneda}">visibility</i>
              </div>
            </div>
      `
      }
    );
    container.innerHTML = output;
      // Select modal
    var mpopup = document.getElementById('mpopupBox');
  
    // Select trigger link
    var mpLink = document.querySelectorAll(".mpopupLink");
  
    // Select close action element
    var close = document.getElementsByClassName("close")[0];
  
    // Open modal once the link is clicked
    mpLink.forEach(btn => {
        btn.addEventListener('click', () => {
            getMoneda(btn.getAttribute('data-value'));
            mpopup.style.display = 'block'; // mostrar el modal
        });
      });
  
    // Close modal once close element is clicked
    close.onclick = function() {
        mpopup.style.display = "none";
    };
  
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && mpopup.style.display === "block") {
        mpopup.style.display = "none";
      }
    });
  
    // Close modal when user clicks outside of the modal box
    window.onclick = function(event) {
        if (event.target == mpopup) {
            mpopup.style.display = "none";
        }
    };
  }
  
  function getMoneda(idMoneda) {
    data = JSON.parse(localStorage.getItem('coinsJSON'));
    data.forEach((moneda) => {
      if (moneda.id_moneda == idMoneda) {
        document.querySelector("#celNombre").innerHTML = "<h6><b>Nombre: </b> " + moneda.nombre + "</h6>";
        document.querySelector("#celDenominacion").innerHTML = "<p><b>Denominación: </b> " + moneda.valor + " pesos</p>";
        document.querySelector("#celFamilia").innerHTML = "<p><b>Familia a la que pertenece: </b> " + moneda.familia + "</p>";
        document.querySelector("#celPresentacion").innerHTML = "<p><b>Presentación: </b> " +  moneda.presentacion + "</p>";
        document.querySelector("#celDecreto").innerHTML = "<p><b>Decreto: </b> " + moneda.decreto + "</p>";
        document.querySelector("#celFechaCirculacion").innerHTML = "<p><b>Fecha de Circulación:</b> " + moneda.fecha_circulacion + "</p>";
        document.querySelector("#celDiametro").innerHTML = "<p><b>Diámetro: </b> " + moneda.diametro+' cm. </p>';
        document.querySelector("#celForma").innerHTML = "<p><b>Forma: </b> " + moneda.forma + "</p>";
        document.querySelector("#celPeso").innerHTML = "<p><b>Peso: </b> " + moneda.peso+' gramos </p>';
        document.querySelector("#celCanto").innerHTML = "<p><b>Canto: </b> " + moneda.canto + "</p>";
        document.querySelector("#celComposicion").innerHTML = "<p><b>Composición: </b> " + moneda.composicion + "</p>";
        document.querySelector("#celDescripcion").innerHTML = "<p><b>Descripción: </b> " + moneda.descripcion + "</p>";
        document.querySelector("#celImagen").src = BASE_URL1+'/admin/Assets/images/uploads/'+moneda.imagen;
      }
    })
  }

  function putImage(imageURL) {

    const imageCacheName = 'site-images-v1';

    self.addEventListener('fetch', (event) => {
        event.respondWith(
          caches.match(event.request).then((response) => {
            if (response) {
              // Si hay una respuesta en cache, la devolvemos
              return response;
            }
    
            // Si no hay respuesta en cache, la buscamos en la red
            return fetch(event.request).then((response) => {
              // Agregamos la respuesta a la cache
              caches.open(imageCacheName).then((cache) => {
                cache.put(event.request, response.clone());
              });
    
              // Devolvemos la respuesta
              return response;
            });
          })
        );
      });
    
      caches.open(imageCacheName).then((cache) => {
        cache.match(imageURL).then((response) => {
          if (response) {
            fetch(imageURL).then((newResponse) => {
              cache.put(imageURL, newResponse);
            });
          }
        });
      });
  }