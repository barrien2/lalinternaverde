<?php
include("bbdd.php");
require('autenticador.php');
?>

<html>

<head>
  <title>ARASI</title>
  <?php

  include('csshead.php');

  ?>
</head>

<body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <?php
    include("header.php");
    ?>
    <div class="uk-flex-center uk-child-width-1-2@s uk-margin" uk-grid>
      <div>
        <div class="uk-card uk-card-default uk-card-body">

          <form action="treballadorsinsignies.php" method="post" enctype="multipart/form-data">
            <h4>Otorgar insignia</h4>


            <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-select">Insignia</label>
              <div class="uk-form-controls">
                <select class="uk-select" id="form-stacked-select" name="insignia">
                  <?php
                  $consulta = "SELECT id, nom FROM insignies";
                  if ($resultado = mysqli_query($con, $consulta)) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      echo "<option value='" . $fila["id"] . "'>" . $fila["nom"] . "</option>";
                    }
                  } else {
                    echo "ERROR BBDD";
                  } ?>
                </select>
              </div>
            </div>



            <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-select2">Treballadors</label>
              <div class="uk-form-controls">
                <select class="uk-select" id="form-stacked-select2" name="treballadors[]" multiple>
                  <?php
                  $consulta = "SELECT id, nom FROM treballadors";
                  if ($resultado = mysqli_query($con, $consulta)) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      echo "<option value='" . $fila["id"] . "'>" . $fila["nom"] . "</option>";
                    }
                  } else {
                    echo "ERROR BBDD";
                  } ?>
                </select>
              </div>
            </div>



            <div class="uk-margin">
              <label class="uk-form-label" for="nom">Data</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="nom" name="data" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="Data">
              </div>
            </div>


            <input type="submit" value="Guardar" class="uk-button uk-button-primary">
            <input type="reset" value="Esborrar" class="uk-button uk-button-danger uk-align-right"><br>
            <input type="hidden" name="action" value="insert">
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>