function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    else if (tecla == 0 || tecla == 9) return true;
    patron = /[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}

function testText(txtString) {
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if (stringText.test(txtString)) {
        return true;
    } else {
        return false;
    }
}

function functionTestEntero(intCant) {
    var intCant = new RegExp(/^[0-9\s]+$/);
    if (intCant.test(intCant)) {
        return true;
    } else {
        return false;
    }
}

function fntEmailValid(email) {
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (stringEmail.test(email) == false) {
        return false;
    } else {
        return true;
    }
}

function fntValidText() {
    let validText = document.querySelectorAll(".validText");
    validText.forEach(function (validText) {
        validText.addEventListener('keyup', function () {
            let inputValue = this.value;
            if(!testText(inputValue)){
                this.classList.add("is-invalid");
            }
            else{
                this.classList.remove("is-invalid");
            }
        });
    });
}

function fntValidEmail() {
    let validEmail = document.querySelectorAll(".validEmail");
    validEmail.forEach(function (validEmail) {
        validEmail.addEventListener('keyup', function () {
            let inputValue = this.value;
            if(!fntEmailValid(inputValue)){
                this.classList.add("is-invalid");
            }
            else{
                this.classList.remove("is-invalid");
            }
        });
    });
}

window.addEventListener('load', function () {
    fntValidText();
    fntValidEmail();
}, false);