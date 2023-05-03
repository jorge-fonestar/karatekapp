<h1>Karatecas </h1>

<?php

if (isset($grabarKarateca)) {
  
    // Obtener las variables recibidas por POST
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $sexo = $_POST['sexo'];
    $cinturon = $_POST['cinturon'];
    
    // Crear la consulta INSERT
    $sql = "INSERT INTO `KARATECAS`(`ID`, `ID_CLUB`, `DNI`, `NOMBRE`, `FECHA_NACIMIENTO`, `TELEFONO`, `SEXO`, `CINTURON`) VALUES (NULL, '$ID_CLUB', '$dni', '$nombre', '$fechaNacimiento', '$telefono', '$sexo', '$cinturon')";
    ejecutar($sql);
}

  

$SELECT = "SELECT * FROM KARATECAS WHERE ID_CLUB='$ID_CLUB' order by ID";
$data = seleccionar($SELECT);
if ($data) {
    while ($row = $data->fetch_assoc()){
        extract($row);
        echo "<option value='$ID'>$NOMBRE $CATEGORIA $PESO</option>";
    }
}
?>


<div class="btn btn-evento" onclick='$("#mdlKaratecas").modal("show");'> <span class="glyphicon glyphicon-plus"></span> Añadir karateca </div>
<a class="btn btn-evento" href='menu'> <span class="glyphicon glyphicon-home"></span> Regresar </a>


<!-- Modal KARATECAS -->
<div class="modal fade" id="mdlKaratecas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style='text-align: left !important;'>
      <div class="modal-header">
        <h5 class="modal-title">Añadir/Editar Karateca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id='frmKaratecas' method="post">
        <div class="modal-body">

            <!-- Nombre -->
            <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
            </div>

            <!-- DNI -->
            <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni">
            </div>

            <!-- Teléfono -->
            <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono">

            <!-- Sexo -->
            <div class="form-group">
            <label for="sexo">Sexo</label>
            <select id='sexo' name='sexo' style='width:100%'>
                <option value='1'>Masculino</option>
                <option value='2'>Femenino</option>
                <option value='3'>Otros?</option>
              </select>
            </div>

            <!-- Cinturón -->
            <div class="form-group">
            <label for="cinturon">Cinturón</label>
            <select id='cinturon' name='cinturon' style='width:100%'>
                <option value="Blanco">Blanco</option>
                <option value="Amarillo">Amarillo</option>
                <option value="Naranja">Naranja</option>
                <option value="Verde">Verde</option>
                <option value="Azul">Azul</option>
                <option value="Marrón">Marrón</option>
                <option value="Negro">Negro</option>
            </select>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" name="grabarKarateca" value='Guardar'/>
        </div>
      </form>
    </div>
  </div>
</div>
