
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