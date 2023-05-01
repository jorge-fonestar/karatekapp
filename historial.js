
function LoadCombate(ID){
  $.post("AJAX", {LoadCombate:ID}, function(r){
    var Data = JSON.parse(r);
    
    $("#txtSerie").val(Data.NOMBRE);
    $("#KeyWords_S").val(Data.KEYWORDS);
    $("#URL_Landing").val(Data.DATA1);
    $("#URL_LandingImg").val(Data.DATA2);
    $("#edtIdMadre").html(Data.ID_MADRE);

    $("#mdlDetalles").modal("show");
  });
}