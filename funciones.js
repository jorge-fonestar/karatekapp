$(document).ready(function(){
  $("#historial").css('display', 'block');
});



function nav(Target, obj){

  $(".nav-link").removeClass('nav-selected');
  $(obj).addClass('nav-selected');

  $(".content").css('display', 'none');
  $("#"+Target).css('display', 'block');

  // $.post("AJAX", {LoadCombate:ID}, function(r){
  //   $("#divDetalles").html(r);
  //   $("#mdlDetalles").modal("show");
  // });
}




function EditKarateka(ID){
  $("#ID").val(ID)

  if (ID=='NEW'){
    // Campos Vacíos

    $("#mdlKaratecas").modal("show");

  }else{
    // Cargar campos de Ajax
    $.post("AJAX", {LoadCombate:ID}, function(r){
      $("#divDetalles").html(r);
      $("#mdlKaratecas").modal("show");
    });
  } 
}


function LoadCombate(ID){
  $.post("AJAX", {LoadCombate:ID}, function(r){
    $("#divDetalles").html(r);
    $("#mdlDetalles").modal("show");
  });
}