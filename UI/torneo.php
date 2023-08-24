<h1>Ficha de Torneo</h1>
<div class='form'>
  <div class="btn btn-light" onclick='loadTorneos(); nav("torneos")'> <span class="glyphicon glyphicon-chevron-left"></span> Atras </div><br><br>
  <input type="hidden" id="id_karateca" v-model="ID">
  <!-- 
    Datos
    Estadísticas
    Combates
    Grabar
    Borrar 
  -->

  <!-- Nombre -->
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" v-model="NOMBRE" @input="setEdited">
  </div>

  <!-- Fecha -->
  <div class="form-group">
    <label for="fecha_nacimiento">Fecha</label>
    <input type="date" class="form-control" v-model="FECHA" @input="setEdited">
  </div>

  <!-- Categoria -->
  <div class="form-group">
    <label for="sexo">Categoría</label>
    <input type="text" class="form-control" v-model="CATEGORIA" @input="setEdited">
    <!-- <select style='width:100%' v-model="CATEGORIA" @input="setEdited">
      <option value='1'>Masculino</option>
      <option value='2'>Femenino</option>
      <option value='3'>Otros?</option>
    </select> -->
  </div>

    <!-- Peso -->
    <div class="form-group">
    <label for="sexo">Peso</label>
    <input type="text" class="form-control" v-model="PESO" @input="setEdited">
  </div>

  <button class="btn btn-light left" @click="delTorneo" v-if="ID !== 'NEW'"><i class="fa-solid fa-trash"></i>  Borrar</button>
  <button class="btn btn-light right" @click="saveTorneo" v-if="Cambios"><i class="fa-solid fa-cloud-arrow-up"></i>  Guardar cambios</button>
</div>