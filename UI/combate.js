let countdownInterval;
let remainingTime = 180;
let countdownRunning = false;
let Sensu = false;
let Linea = 0;
let AmonestacionesAO=0;
let AmonestacionesAKA=0;


function ComenzarCombate(){
  setTimerMin();
  //TODO: Restablecer todos los datos
  nav('combate', null, 'flex');
}

function startStopCountdown() {
  if (!countdownRunning) {
    start()
  } else {
    stop()
  }
}

function stop(){
    clearInterval(countdownInterval);
    document.getElementById("btn-timer").textContent = "¡Hajime!";
    countdownRunning = false;
}

function start(){
    countdownInterval = setInterval(updateCountdown, 1000);
    document.getElementById("btn-timer").textContent = "Yame";
    countdownRunning = true;
}

function updateCountdown() {
  remainingTime--;
  PintarTimer();
  if (remainingTime < 0) {
    clearInterval(countdownInterval);
    timer.textContent = "FIN";
  }
}

function PintarTimer(){
  const timer = document.getElementById("timer");
  const minutes = Math.floor(remainingTime / 60);
  const seconds = remainingTime % 60;
  timer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

function CountdownMas(){
  remainingTime++;
  remainingTime++;
  PintarTimer()
}

function CountdownMenos(){
  remainingTime--;
  PintarTimer()
}

function setTimerMin(){
  remainingTime = parseInt($("#timerIni").val()) * 60;
  PintarTimer()
}

function NuevoEvento(Tipo, Color){
  stop();
  $("#Tipo").html(Tipo);
  $("#Color").html(Color);

  if (Tipo=='Amonestación'){
    $('#modal-amonestacion').modal('show');
    $('#modal-titulo').html(Tipo);
    
  }else{
    $('#modal-evento').modal('show');
    $('#modal-titulo').html(Tipo);
  }
  
}

function SalirDelCombate(){
  $('#modal-menu').modal('show');
}

function GrabarEvento(Tecnica, Puntos){
  Situacion = $("#Tipo").html();
  Color = $("#Color").html()

  // Grabamos la linea
  if (Color=='AO') rgb = "007bff"; else rgb = "dc3545";
  addLine(Color, Tecnica, Situacion, Puntos)
  

  if (Situacion === 'Amonestación'){
    // Amonestación
    AmonestacionSet(Color, Puntos);

    // Perdida de Sensu
    if (Sensu==true && $("#SensuOff").prop("checked")) {
      SensuSet(false);
      addLine(Color, "Sensu perdido", Situacion);
    }

  }else{
    // Puntos
    Marcador = parseInt($('#marcador-'+Color).html());
    $('#marcador-'+Color).html(Marcador + Puntos);

    SensuOnChecked = $("#SensuOn").prop("checked");

    // Ganar Sensu
    if (Sensu==false && SensuOnChecked) {
      SensuSet(Color);
      addLine(Color, "Sensu", Situacion);
    }
  }


  $('.modal').modal('hide');
}

function addLine(Color, Tecnica, Situacion, Puntos){
  Linea++;

  Minuto = $("#timer").html()
  if (Color=='AO') rgb = "007bff"; else rgb = "dc3545";

  if (Situacion === 'Amonestación') Puntos = 0;

  const newRow = `
    <div id='linea-`+Linea+`' class="row" style="color:#`+rgb+` !important;" Puntos='`+Puntos+`' Color='`+Color+`'>
      <div class="col-2">` + Minuto + `</div>
      <div class="col-10">` + Tecnica + ` en ` + Situacion + `</div>
    </div>
  `;
  $('#registros').append(newRow);
}

function AmonestacionSet(Color, Chui){
  if (Color=='AO'){ AmonestacionesAO = Chui; }else{ AmonestacionesAKA = Chui; }

  $(".bg-amonestacion").removeClass('bg-danger');
  $(".bg-amonestacion").addClass('bg-dark');

  for (var i = 1; i <= AmonestacionesAO; i++) {
    $("#bga-AO-"+i).addClass('bg-danger');
    $("#bga-AO-"+i).removeClass('bg-dark');
  }

  for (var i = 1; i <= AmonestacionesAKA; i++) {
    $("#bga-AKA-"+i).addClass('bg-danger');
    $("#bga-AKA-"+i).removeClass('bg-dark');
  }

}

function SensuSet(Cual){
  Sensu = Cual;
  if (Cual==false){
    $("#SensuDivOff").hide();
    $("#SensuDivOn").show();
    $("#sensu-AO").removeClass('bg-warning');
    $("#sensu-AO").addClass('bg-dark');
    $("#sensu-AKA").removeClass('bg-warning');
    $("#sensu-AKA").addClass('bg-dark');

  }else if (Cual=='AKA'){
    $("#SensuDivOn").hide();
    $("#SensuDivOff").show();
    $("#sensu-AO").removeClass('bg-warning');
    $("#sensu-AO").addClass('bg-dark');
    $("#sensu-AKA").removeClass('bg-dark');
    $("#sensu-AKA").addClass('bg-warning');
    
  }else{
    $("#SensuDivOn").hide();
    $("#SensuDivOff").show();
    $("#sensu-AKA").removeClass('bg-warning');
    $("#sensu-AKA").addClass('bg-dark');
    $("#sensu-AO").removeClass('bg-dark');
    $("#sensu-AO").addClass('bg-warning');
    
  }
}

function eliminarLinea(){
  if (confirm('Seguro que quieres eliminar la última?')){
    
    // Restar Puntos
    var PuntosLine = $('#linea-'+Linea).attr('Puntos');
    if (PuntosLine>0){
      var ColorLine = $('#linea-'+Linea).attr('Color');
      Marcador = parseInt($('#marcador-'+ColorLine).html());
      $('#marcador-'+ColorLine).html(Marcador - PuntosLine);
    }
    

    $('#linea-'+Linea).remove();
    Linea--;
  }
}

function GrabarCombate(){

  LoadingOn();

  // Enviamos los datos para grabar

  // Sensu
  let sensu = document.getElementById('sensu-AO').classList.contains('bg-warning') ? 'AO' : 'AKA';

  // Hantei (Preguntar solo si hay empate?)
  let hantei = '';

  // Lista de Registros
  var registros = [];
  $('#registros').children().each(function() {
    var $linea = $(this);
    
    var minuto = $linea.find(".col-2").text().trim();
    
    var color = $linea.css("color");
    var color = (color === 'rgb(0, 123, 255)') ? 'AO' : 'AKA';

    var texto = $linea.find(".col-8, .col-10").text().trim();
    var partes = texto.split(" en ");
    var tecnica = partes[0];
    var situacion = partes[1];

    var registro = {
      "minuto": minuto,
      "color": color,
      "tecnica": tecnica,
      "situacion": situacion
    };
    
    registros.push(registro);
  });


  var Data = {
    IdTorneo: $("#IdTorneo").val(),
    Ronda: $("#Ronda").val(),
    NombreAO: $("#NombreAO").val(),
    NombreAKA: $("#NombreAKA").val(),
    PuntosAO: $("#marcador-AO").html(),
    PuntosAKA: $("#marcador-AKA").html(),
    Sensu:sensu,
    Hantei:hantei,
    Registros: registros
  };

  // Realizar la función de grabado
  $.post("AJAX", {GrabarCombate: true, Data: Data})
    .done(function(response) {
      var Msg;
      if (response!='1') {
        Msg = response; 
        tipo = 'error';
      }else{
        Msg = "Se han grabado los datos correctamente";
        tipo = 'success';
      }
      loadHistorial();
      LoadingOff();
      Alerta(Msg, 5000, tipo);
      nav("historial");
      
    })
    .fail(function(xhr, status, error) {
      LoadingOff();
      Alerta(error, 5000, tipo='error');

    });

}