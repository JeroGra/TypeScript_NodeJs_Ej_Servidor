"use strict";
var xhttp = new XMLHttpRequest();
var formData = new FormData();
function Agregar() {
    var legajo = (Number)(document.getElementById("legajo").value);
    var apellido = document.getElementById("apellido").value;
    var nombre = document.getElementById("nombre").value;
    var foto = document.getElementById("foto");
    xhttp.open("POST", "BACKEND/nexo_poo.php", true);
    xhttp.setRequestHeader("enctype", "multipart/form-data");
    formData.append('accion', "agregar");
    formData.append('legajo', legajo.toString());
    formData.append('apellido', apellido);
    formData.append('nombre', nombre);
    formData.append('foto', foto.files[0]);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            alert(xhttp.responseText);
            console.log(xhttp.responseText);
        }
    };
}
function Listar() {
    xhttp.open("GET", "BACKEND/nexo_poo.php?accion=listar", true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("divListado").innerHTML = xhttp.responseText;
        }
    };
}
function Verificar() {
    var legajo = (Number)(document.getElementById("legajo_v").value);
    xhttp.open("POST", "BACKEND/nexo_poo.php", true);
    formData.append('accion', "verificar");
    formData.append('legajo', legajo.toString());
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            alert(xhttp.responseText);
            console.log(xhttp.responseText);
        }
    };
}
function Modificar() {
    var legajo = (Number)(document.getElementById("legajo_m").value);
    var apellido = document.getElementById("apellido_m").value;
    var nombre = document.getElementById("nombre_m").value;
    xhttp.open("POST", "BACKEND/nexo_poo.php", true);
    formData.append('accion', "modificar");
    formData.append('legajo', legajo.toString());
    formData.append('apellido', apellido);
    formData.append('nombre', nombre);
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            alert(xhttp.responseText);
            console.log(xhttp.responseText);
        }
    };
}
function Borrar() {
    var legajo = (Number)(document.getElementById("legajo_b").value);
    xhttp.open("POST", "BACKEND/nexo_poo.php", true);
    formData.append('accion', "borrar");
    formData.append('legajo', legajo.toString());
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            alert(xhttp.responseText);
            console.log(xhttp.responseText);
        }
    };
}
function ListarObjetos() {
    xhttp.open("POST", "BACKEND/nexo_poo.php", true);
    formData.append('accion', "listarObjetos");
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var ret = xhttp.responseText;
            var retJSON = JSON.parse(ret);
            document.getElementById("divListadoObj").innerHTML = retJSON;
        }
    };
}
function ListarTabla() {
    xhttp.open("POST", "BACKEND/nexo_poo.php", true);
    formData.append('accion', "listarTabla");
    xhttp.send(formData);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var ret = xhttp.responseText;
            var retJSON = JSON.parse(ret);
            document.getElementById("divListadoObj").innerHTML = retJSON;
        }
    };
}
//# sourceMappingURL=funciones.js.map