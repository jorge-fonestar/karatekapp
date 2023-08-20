$(document).ready(function(){
  $("#historial").css('display', 'block');
  
});

document.addEventListener('touchmove', function(event) {
  event.preventDefault();
  event.stopPropagation();
}, false);

window.addEventListener('beforeunload', function(event) {
  // Cancelar la descarga de la página
  event.preventDefault();

  // Mostrar un mensaje de confirmación personalizado
  event.returnValue = '';
  return '';
});



function nav(Target, obj = null, display = 'block'){

  // Si entramos en COMBATE quitamos los menus, y si no los mostramos
  if (Target=="combate"){
    $("#mnuTop").addClass("hidden");
    $("#mnuBottom").addClass("hidden");
  }else{
    $("#mnuTop").removeClass("hidden");
    $("#mnuBottom").removeClass("hidden");
  }


  // Si viene click de un objeto, marcamos el menú
  if (obj !== null) {
    $(".nav-link").removeClass('nav-selected');
    $(obj).addClass('nav-selected');
  }

  $(".content").css('display', 'none');
  $("#"+Target).css('display', display);
}


function Alerta(message, duration, tipo='info') {
  const Alert = $('#Alert');
  const AlertContainer = $('#AlertContainer');

  // Tipo
  Alert.removeClass('alert-error');
  Alert.removeClass('alert-info');
  Alert.removeClass('alert-success');
  Alert.addClass('alert-'+tipo);

  AlertContainer.html(message);
  Alert.css('display', 'flex');
  setTimeout(function() {
    Alert.css('display', 'none');
  }, duration);
}



function LoadingOn() {
  var overlay = document.getElementById("loading-overlay");
  overlay.style.display = "flex"; // Mostrar el div de carga
}

function LoadingOff() {
  var overlay = document.getElementById("loading-overlay");
  overlay.style.display = "none"; // Ocultar el div de carga
}


















// Acciones de la aplicación


function LoadKarateca(ID){
  LoadingOn();

  if (ID=='NEW'){
    // Campos Vacíos
    karateca.nombre = "";
    karateca.fecha_nacimiento = "";
    karateca.dni = "";
    karateca.telefono = "";
    karateca.sexo = "";
    karateca.cinturon = "";
    LoadingOff();
    nav('karateca');

  }else{

    $.post("AJAX", {LoadKarateca: ID}, function (response) {
      var json = JSON.parse(response);
      if (json){
        // Actualizar los valores en la instancia de Vue
        karateca.nombre = json.NOMBRE;
        karateca.fecha_nacimiento = json.FECHA_NACIMIENTO;
        karateca.dni = json.DNI;
        karateca.telefono = json.TELEFONO;
        karateca.sexo = json.SEXO;
        karateca.cinturon = json.CINTURON;
        nav('karateca');
      }
      LoadingOff();
    }).fail(function (xhr, status, error) { Alerta(xhr.status + " " + error, 5000, 'error'); LoadingOff(); });
  } 
}


function LoadCombate(ID){
  LoadingOn();
  $.post("AJAX", {LoadCombate:ID}, function(r){
    LoadingOff();
    $("#divDetalles").html(r);
    $("#mdlDetalles").modal("show");
  });
}