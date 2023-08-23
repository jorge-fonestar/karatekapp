

var karatecas = new Vue({
  el: '#karatecas',
  data: { karatecas: [] },
  created () { loadKaratecas(); },
  methods: {

    NewKarateca(){
      // Campos Vacíos
      karateca.ID = "NEW";
      karateca.NOMBRE = "Nuevo!";
      karateca.FECHA_NACIMIENTO = "";
      karateca.DNI = "";
      karateca.TELEFONO = "";
      karateca.SEXO = "";
      karateca.CINTURON = "";
      LoadingOff();
      nav('karateca');
    },

    loadKarateca: function(ID) {
      LoadingOn();
      $.post("AJAX", {LoadKarateca: ID}, function (response) {
        var json = JSON.parse(response);
        if (json){
          // Actualizar los valores en la instancia de Vue
          karateca.ID = json.ID;
          karateca.NOMBRE = json.NOMBRE;
          karateca.FECHA_NACIMIENTO = json.FECHA_NACIMIENTO;
          karateca.DNI = json.DNI;
          karateca.TELEFONO = json.TELEFONO;
          karateca.SEXO = json.SEXO;
          karateca.CINTURON = json.CINTURON;
          nav('karateca');
        }else{Alerta("Hay un error en el contenido", 5000, 'error')}
        LoadingOff();
      }).fail(function (xhr, status, error) { Alerta(xhr.status + " " + error, 5000, 'error'); LoadingOff(); });
    } 
    
  }
});

var karateca = new Vue({
  el: '#karateca',
  data: {
    ID: "",
    NOMBRE: "",
    FECHA_NACIMIENTO: "",
    DNI: "",
    TELEFONO: "",
    SEXO: "",
    CINTURON: "",
    Cambios: false
  },
  methods: {

    setEdited: function(){
      this.Cambios = true;
    },

    saveKarateca: function() {
      LoadingOn();

      // Enviamos los datos para grabar
      var Data = {
        ID: this.ID,
        NOMBRE: this.NOMBRE,
        FECHA_NACIMIENTO: this.FECHA_NACIMIENTO,
        DNI: this.DNI,
        TELEFONO: this.TELEFONO,
        SEXO: this.SEXO,
        CINTURON: this.CINTURON
      };

      // Realizar la función de grabado aquí
      $.post("AJAX", {GrabarKarateca: true, Data: Data})
        .done(function(response) {
          var Msg;
          if (response!='1') {
            Msg = response; 
            tipo = 'error';
          }else{
            Msg = "Se han grabado los datos correctamente";
            tipo = 'success';
          }
          karateca.Cambios = false;
          LoadingOff();
          Alerta(Msg, 5000, tipo);
          // Restablecer la propiedad edited a false después de grabar
          
        })
        .fail(function(xhr, status, error) {
          LoadingOff();
          Alerta(error, 5000, tipo='error');

        });
      
    },

  }
});


var historial = new Vue({
  el: '#historial',
  data: { combates: [] },
  created (){ loadHistorial(); },
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



var torneos = new Vue({
  el: '#torneos',
  data: { torneos: [] },
  created () { loadTorneos(); },
  methods: {

    NewTorneo(){
      // Campos Vacíos
      torneo.ID = "NEW";
      torneo.NOMBRE = "Nuevo!";
      torneo.FECHA = "";
      torneo.CATEGORIA = "";
      torneo.PESO = "";
      LoadingOff();
      nav('torneo');
    },

    loadTorneo: function(ID) {
      LoadingOn();
      $.post("AJAX", {LoadTorneo: ID}, function (response) {
        var json = JSON.parse(response);
        if (json){
          // Actualizar los valores en la instancia de Vue
          torneo.ID = json.ID;
          torneo.NOMBRE = json.NOMBRE;
          torneo.FECHA = json.FECHA;
          torneo.CATEGORIA = json.CATEGORIA;
          torneo.PESO = json.PESO;
          nav('torneo');
        }else{Alerta("Hay un error en el contenido", 5000, 'error')}
        LoadingOff();
      }).fail(function (xhr, status, error) { Alerta(xhr.status + " " + error, 5000, 'error'); LoadingOff(); });
    } 
    
  }
});

var torneo = new Vue({
  el: '#torneo',
  data: {
    ID: "",
    NOMBRE: "",
    FECHA: "",
    CATEGORIA: "",
    PESO: "",
    Cambios: false
  },
  methods: {

    setEdited: function(){
      this.Cambios = true;
    },

    saveTorneo: function() {
      LoadingOn();

      // Enviamos los datos para grabar
      var Data = {
        ID: this.ID,
        NOMBRE: this.NOMBRE,
        FECHA: this.FECHA,
        CATEGORIA: this.CATEGORIA,
        PESO: this.PESO,
      };

      // Realizar la función de grabado aquí
      $.post("AJAX", {GrabarTorneo: true, Data: Data})
        .done(function(response) {
          var Msg;
          if (response!='1') {
            Msg = response; 
            tipo = 'error';
          }else{
            Msg = "Se han grabado los datos correctamente";
            tipo = 'success';
          }
          torneo.Cambios = false;
          LoadingOff();
          Alerta(Msg, 5000, tipo);
          // Restablecer la propiedad edited a false después de grabar
          
        })
        .fail(function(xhr, status, error) {
          LoadingOff();
          Alerta(error, 5000, tipo='error');

        });
    },
  }
});