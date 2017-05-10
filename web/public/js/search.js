/*#AITOR FUNCION PARA SABER LOS DIAS DE DIFERENCIA
            var desdeDate =  new Date(desde.split('/')[1]+"/"+desde.split('/')[0] +"/"+ desde.split('/')[2]);
            var hastaDate =  new Date(hasta.split('/')[1]+""+hasta.split('/')[0] +""+ hasta.split('/')[2]);
            var timeDiff = Math.abs(hastaDate.getTime() - desdeDate.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); */


var peticion = null;
var elementoSeleccionado = -1;
var sugerencias = null;
var cacheSugerencias = {};

function inicializa_xhr() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

Array.prototype.formateaLista = function () {
    var codigoHtml = "";

    codigoHtml = "<ul>";
    for (var i = 0; i < this.length; i++) {
        if (i == elementoSeleccionado) {
            codigoHtml += "<li class=\"seleccionado\">" + this[i] + "</li>";
        } else {
            codigoHtml += "<li>" + this[i] + "</li>";
        }
    }
    codigoHtml += "</ul>";

    return codigoHtml;
};

function autocompleta() {

    var desde = $("#from").val();
    var hasta = $("#to").val();
    var desdeDate =  desde.split('/')[1]+""+desde.split('/')[0] +""+ desde.split('/')[2];
    var hastaDate =  hasta.split('/')[1]+""+hasta.split('/')[0] +""+ hasta.split('/')[2];
    var dif =  parseInt(hastaDate)-parseInt(desdeDate);
    if(desde.length>0){
        if(hasta.length>0){
               
            if(dif>0){
                alert("Fecha correcta");
            }else{
                alert("Pepe no esta");
            }

        }else{
            alert("Debes introducir la fecha de final de reserva.");
        }
    }else{
        alert("Debes introducir la fecha de inicio de reserva.");
    }

    

    /*var elEvento = arguments[0] || window.event;
    var tecla = elEvento.keyCode;

    if (tecla == 40) { // Flecha Abajo
        if (elementoSeleccionado + 1 < sugerencias.length) {
            elementoSeleccionado++;
        }
        muestraSugerencias();
    } else if (tecla == 38) { // Flecha Arriba
        if (elementoSeleccionado > 0) {
            elementoSeleccionado--;
        }
        muestraSugerencias();
    } else if (tecla == 13) { // ENTER o Intro
        seleccionaElemento();
    } else {
        var texto = document.getElementById("buscar").value;

        // Si es la tecla de borrado y el texto es vacío, ocultar la lista
        if (tecla == 8 && texto == "") {
            borraLista();
            return;
        }

        if (cacheSugerencias[texto] == null) {
            

            var request = $.ajax({
                url: "controller/searchpelicula_ctl.php",
                type: "POST",
                data: {str: $("#buscar").val()},
                dataType: "html",
                success: function (data) {
                    

                    sugerencias = eval('(' + data + ')');
                    if (sugerencias.length == 0) {
                        sinResultados();
                    } else {
                        cacheSugerencias[texto] = sugerencias;
                        actualizaSugerencias();
                    }


                }
            });

        } else {
            sugerencias = cacheSugerencias[texto];
            actualizaSugerencias();
        }
    }*/


}

function carregaResultats(dades) {
    $x = dades;

    
}

function sinResultados() {
    document.getElementById("sugerencias").innerHTML = "No s'han trobat habitacions";
    document.getElementById("sugerencias").style.display = "block";
}

function actualizaSugerencias() {
    elementoSeleccionado = -1;
    muestraSugerencias();
}

function seleccionaElemento() {
    if (sugerencias[elementoSeleccionado]) {

        var res = sugerencias[elementoSeleccionado].split(" -");

        window.location.href = '?ctl=pelicula&act=veure&id=' + res[0];

    }
}

function muestraSugerencias() {
    var zonaSugerencias = document.getElementById("sugerencias");

    zonaSugerencias.innerHTML = sugerencias.formateaLista();
    zonaSugerencias.style.display = 'block';
}

function borraLista() {
    document.getElementById("sugerencias").innerHTML = "";
    document.getElementById("sugerencias").style.display = "none";
}

function stat(action, user) {
    if (!user) {
        user = "";
    }
    document.getElementById('login_action').innerHTML = action;
    document.getElementById('login_user').innerHTML = "<a>" + user + "</a>";
}

window.onload = function () {

    $("#searchHabitacions").keyup(autocompleta);
    //$("#searchHabitacions").focus();
    compruebaHabilitados();


   
}

function compruebaHabilitados(){

    

}