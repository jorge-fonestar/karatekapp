let countdownInterval;
let remainingTime = 180;
let countdownRunning = false;
let Sensu = false;
let Linea = 0;
let AmonestacionesAO=0;
let AmonestacionesAKA=0;

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

function GrabarEvento(Evento, Puntos){
  Tipo = $("#Tipo").html();
  Minuto = $("#timer").html()
  Color = $("#Color").html()

  if (Tipo === 'Amonestación'){
    // Amonestación
    if (Sensu!=false && $("#SensuOff").prop("checked")) {SensuSet(false);}
    AmonestacionSet(Color, Puntos);

  }else{
    // Puntos
    Marcador = parseInt($('#marcador-'+Color).html());
    $('#marcador-'+Color).html(Marcador + Puntos);

    SensuOnChecked = $("#SensuOn").prop("checked");
    if (Sensu==false && SensuOnChecked) {SensuSet(Color);}
  }

  if (Color=='AO') rgb = "007bff"; else rgb = "dc3545";

  Linea++;
  const newRow = `
    <div id='linea-`+Linea+`' class="row" style="color:#`+rgb+` !important;" onclick='eliminarLinea(`+Linea+`)'>
      <div class="col-2">` + Minuto + `</div>
      <div class="col-8">` + Evento + ` en ` + Tipo + `</div>
      <div class="col-2">` + Puntos + `</div>
    </div>
  `;
  $('#registros').append(newRow);

  $('.modal').modal('hide');
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

function eliminarLinea(Linea){
  if (confirm('Seguro que quieres eliminar esta linea?')){
    $('#linea-'+Linea).remove();
  }
}

function GrabarCombate(){
  // Crear el formulario invisible
  var form = $("<form>", { method: 'post'});

  // Agregar las variables al formulario
  form.append($("<input>", { type: "text", name: "grabarCombate", value: '1' }));

  form.append($("<input>", { type: "text", name: "IdTorneo", value: $("#IdTorneo").val() }));
  form.append($("<input>", { type: "text", name: "Ronda", value: $("#Ronda").val() }));
  form.append($("<input>", { type: "text", name: "NombreAO", value: $("#NombreAO").val() }));
  form.append($("<input>", { type: "text", name: "NombreAKA", value: $("#NombreAKA").val() }));
  
  $("body").append(form);

  // Enviamos
  form.submit();

}