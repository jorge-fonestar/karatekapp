

var karatecas = new Vue({
  el: '#karatecas',
  data: {
    karatecas: []
  },
  methods: {
    loadKarateca: function(ID) {
      LoadingOn();

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
});

var karateca = new Vue({
  el: '#karateca',
  data: {},
  methods: {
    loadKarateca: function(id) {
      
    }
  }
});


var historial = new Vue({
  el: '#historial',
  data: {
    combates: []
  },
  methods: {
    loadCombate: function(id) {
      // Lógica para cargar el combate según el ID
      LoadingOn();
      $.post("AJAX", {LoadCombate:id}, function(r){
        LoadingOff();
        $("#divDetalles").html(r);
        $("#mdlDetalles").modal("show");
      });
    }
  }
});