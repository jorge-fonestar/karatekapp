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

  // Si viene click de un objeto, marcamos el menú
  if (obj !== null) {
    $(".nav-link").removeClass('nav-selected');
    $(obj).addClass('nav-selected');
  }

  $(".content").css('display', 'none');
  $("#"+Target).css('display', display);
}

function ajax(EndPoint, DATA) {
  return $.post(EndPoint, DATA)
    .done(function (response) {
      // Retornar la respuesta en caso de éxito
      return response;
    })
    .fail(function (xhr, status, error) {
      // Mostrar un modal con el mensaje de error
      Alerta(xhr.status + " " + error, 5000, 'error');
      // Retornar FALSE en caso de error
      return false;
    });
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
  Alert.addClass('show');
  setTimeout(function() {
    Alert.removeClass('show');
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
    var json = ajax("karateca", {id: ID});
    if (json){
      // Actualizar los valores en la instancia de Vue
      karateca.nombre = json.nombre;
      karateca.fecha_nacimiento = json.fecha_nacimiento;
      karateca.dni = json.dni;
      karateca.telefono = json.telefono;
      karateca.sexo = json.sexo;
      karateca.cinturon = json.cinturon;
      nav('karateca');
    }
    LoadingOff();
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