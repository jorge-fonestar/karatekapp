<h1>Karatecas</h1>
<a class="btn btn-evento" href='menu'> <span class="glyphicon glyphicon-plus"></span> Nuevo Karateca </a>

<?php
if (isset($grabarKarateca)) {
  
    // Obtener las variables recibidas por POST
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $sexo = $_POST['sexo'];
    $cinturon = $_POST['cinturon'];
    
    if ($ID=='NEW'){
      $sql = "INSERT INTO `KARATECAS`(`ID`, `ID_CLUB`, `DNI`, `NOMBRE`, `FECHA_NACIMIENTO`, `TELEFONO`, `SEXO`, `CINTURON`) VALUES (NULL, '$ID_CLUB', '$dni', '$nombre', '$fechaNacimiento', '$telefono', '$sexo', '$cinturon')";
      
    }else{
      $sql = "UPDATE `KARATECAS` 
              set DNI='$dni', NOMBRE='$nombre', FECHA_NACIMIENTO='$fechaNacimiento', TELEFONO='$telefono', SEXO='$sexo', CINTURON='$cinturon' 
              WHERE ID='$ID'";
    }
    ejecutar($sql);
}


// Listado de Karatekas registrados

$SELECT = "SELECT * FROM KARATECAS WHERE ID_CLUB='$ID_CLUB' order by NOMBRE";
$data = seleccionar($SELECT);
if ($data) {
    while ($row = $data->fetch_assoc()){
        extract($row);
        ?>
        <div class="card mb-3 bg-dark text-white" style='width: 100%; cursor:pointer;'>
            <div class="card-header">
                <span style='font-size:16px;'><?php echo $NOMBRE;?></span>
            </div>
            <div class="card-body text-light">
              <div class="btn btn-evento" onclick="editar_karateka()"><i class="fas fa-chart-bar"></i> Estadísticas</div>
              <div class="btn btn-evento" onclick="editar_karateka()"><i class="fas fa-fist-raised"></i> Combates</div>
              <div class="btn btn-evento" onclick="editar_karateka()"><i class="fas fa-pencil-alt"></i> Editar</div>
              <div class="btn btn-evento" onclick="editar_karateka()"><i class="fas fa-trash"></i> Eliminar</div>
            </div>
        </div>
        <?php
    }
}
?>




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
      
        <div class="modal-body">
            <input type="hidden" id="ID" name="ID" value='NEW'>

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
    </div>
  </div>
</div>
</div>