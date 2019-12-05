<?php 
  include("bbdd.php");
  require('autenticador.php');
?>

<html>
<head>

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
            <h4>Consultar insignies atorgades de: </h4>
            <h6>Treballador</h6>


            <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-select">Insignia</label>
              <div class="uk-form-controls">
                <select class="uk-select" id="form-stacked-select" name="treballador">
                <option value="*tots*" >*Tots*</option>
                <?php
                    $consulta = "SELECT id, nom FROM treballadors";
                    if ($resultado = mysqli_query($con, $consulta)) {
                      while ($fila = mysqli_fetch_assoc($resultado)) {
                         echo "<option value='".$fila["id"]."'>".$fila["nom"]."</option>";
                      }
                    }else{
                      echo "ERROR BBDD";
                    }                
                ?>
                </select>
              </div>
            </div>  
              
            
           <input type="submit" value="Consultar" class="uk-button uk-button-primary">
            <input type="hidden" name="action" value="filter">      
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>