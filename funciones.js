$(document).ready(function() {

  // Cargamos el Autocomplete
  $(".autocomplete-karateca").on("change input focusout", function() {
    validarNombreKarateca($(this));
  });

  $(".autocomplete-karateca").autocomplete({
    source: nombresKaratecas,
    minLength: 0,
    select: function(event, ui) {
      validarNombreKarateca($(this));
    }
  });

  $("#btnSelectAO").click(function() {
    $("#NombreAO").autocomplete("search", "").focus(); 
  });

  $("#btnSelectAKA").click(function() {
    $("#NombreAKA").autocomplete("search", "").focus();
  });

  $("#btnSelectSrch").click(function() {
    $("#srchNombre").autocomplete("search", "").focus();
  });
  nav("historial");
});

function validarNombreKarateca($input) {
  var valorInput = $input.val();

  if (nombresKaratecas.indexOf(valorInput) === -1) {
    $input.removeClass("valid-name");
  } else {
    $input.addClass("valid-name");
  }
}


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

  if (karateca.Cambios) {
    const userConfirmed = window.confirm("Hay cambios no guardados. ¿Estás seguro de que quieres avanzar?");
  
    if (userConfirmed) {
      karateca.Cambios = false;

    } else {
      return;
    }
  }
  


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









/////////      Historial      /////////

function loadHistorial(){
  LoadingOn()
  var FILTROS = {
    Nombre: $("#srchNombre").val(),
    FechaIni: $("#srchFechaIni").val(),
    FechaFin: $("#srchFechaFin").val(),
    IdTorneo: $("#srchIdTorneo").val(),
    Ronda: $("#srchRonda").val(),
  };
  $.post("AJAX", {loadHistorial: true, filtros: FILTROS}, function (response) {
    var json = JSON.parse(response);
    if (json){
        // Actualizar los valores en la instancia de Vue
        historial.combates = json;
    }
    LoadingOff();
  }).fail(function (xhr, status, error) { Alerta(xhr.status + " " + error, 5000, 'error'); LoadingOff(); });

}

////////////////////////////////////////








/////////      Karatekas      /////////
var nombresKaratecas = ["Iván", "Carlos", "María", "Juan", "Luis"];

function loadKaratecas(){
    $.post("AJAX", {ListadoKaratecas: true}, function (response) {
    var json = JSON.parse(response);
    if (json){
        // Actualizar los valores en la instancia de Vue
        karatecas.karatecas = json;

        // Actualizar el autocompletado
        nombresKaratecas = [];
        for (let i = 0; i < json.length; i++) {
          nombresKaratecas.push(json[i].NOMBRE); // Asegúrate de ajustar esta línea para obtener el nombre correctamente
        }
       
        $(".autocomplete-karateca").autocomplete({
          source: nombresKaratecas
        });
    }
    }).fail(function (xhr, status, error) { Alerta(xhr.status + " " + error, 5000, 'error'); LoadingOff(); });
}



////////////////////////////////////////







/////////      Torneos      /////////
function loadTorneos(){
    $.post("AJAX", {ListadoTorneos: true}, function (response) {
    var json = JSON.parse(response);
    if (json){
        // Actualizar los valores en la instancia de Vue
        torneos.torneos = json;

        // Actualizamos el Select de la definicion de nuevo combate
        var select = $("#IdTorneo");

        select.empty();
        select.append(new Option("ENTRENAMIENTO / NO OFICIAL", 0));
        console.log(json);

        for (var i = 0; i < json.length; i++) {
          select.append(new Option(json[i].NOMBRE, json[i].ID));
        }
        
        // Actualizar cualquier componente de terceros que maneje el select
        // Por ejemplo, si estás utilizando algún plugin de selección personalizada
        select.trigger("chosen:updated");
    }
    }).fail(function (xhr, status, error) { Alerta(xhr.status + " " + error, 5000, 'error'); LoadingOff(); });
}////////////////////////////////////////