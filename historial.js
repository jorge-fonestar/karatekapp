
function LoadCombate(ID){
  $.post("AJAX", {LoadCombate:ID}, function(r){
    $("#divDetalles").html(r);
    $("#mdlDetalles").modal("show");
  });
}