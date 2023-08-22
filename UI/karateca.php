<h1>Ficha de Karateca</h1>
<div class='form'>
  <div class="btn btn-light" onclick='loadKaratecas(); nav("karatecas")'> <span class="glyphicon glyphicon-chevron-left"></span> Atras </div><br><br>
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

  <!-- Fecha de Nacimiento -->
  <div class="form-group">
    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" v-model="FECHA_NACIMIENTO" @input="setEdited">
  </div>

  <!-- DNI -->
  <div class="form-group">
    <label for="dni">DNI</label>
    <input type="text" class="form-control" id="dni" name="dni" v-model="DNI" @input="setEdited">
  </div>

  <!-- Teléfono -->
  <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="tel" class="form-control" id="telefono" name="telefono" v-model="TELEFONO" @input="setEdited">
  </div>

  <!-- Sexo -->
  <div class="form-group">
    <label for="sexo">Sexo</label>
    <select id='sexo' name='sexo' style='width:100%' v-model="SEXO" @input="setEdited">
      <option value='1'>Masculino</option>
      <option value='2'>Femenino</option>
      <option value='3'>Otros?</option>
    </select>
  </div>

  <!-- Cinturón -->
  <div class="form-group">
    <label for="cinturon">Cinturón</label>
    <select id='cinturon' name='cinturon' style='width:100%' v-model="CINTURON" @input="setEdited">
      <option value="Blanco">Blanco</option>
      <option value="Amarillo">Amarillo</option>
      <option value="Naranja">Naranja</option>
      <option value="Verde">Verde</option>
      <option value="Azul">Azul</option>
      <option value="Marrón">Marrón</option>
      <option value="Negro">Negro</option>
    </select>
  </div>

  <button class="btn btn-light right" @click="saveKarateca" v-if="Cambios"><i class="fa-solid fa-cloud-arrow-up"></i>  Guardar cambios</button>
</div>