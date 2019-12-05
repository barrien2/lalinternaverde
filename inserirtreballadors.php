<?php 

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
<?php if($_SESSION['rol'] > 1) { ?>
            <form method="post" enctype="multipart/form-data">
              <h4>Inserir treballadors</h4>

              <div class="uk-margin" uk-margin>
              <label class="uk-form-label" for="image">Fitxer xml</label>
              <div uk-form-custom="target: true">
                <input type="file" name="fitxer">
                <input class="uk-input uk-form-width-medium" type="text" placeholder="Selecciona fitxer xml" disabled>
              </div>
            </div>




            
              <input type="submit" value="Executar script" class="uk-button uk-button-primary">
            <input type="reset" value="Esborrar" class="uk-button uk-button-danger uk-align-right"><br>
            <input type="hidden" name="action" value="insert">
            </form>
<div>

          <?php
}
          include("bbdd.php");

          //comprovar que s'ha enviat desde el formulari de inserir
          if ($_SESSION['rol'] > 1 && isset($_POST["action"]) && $_POST["action"] == "insert") {
            //pujar imatge al servidor
            $target_dir = "uploads/";
            if (is_dir($target_dir)) {
              $target_file = $target_dir . basename($_FILES["fitxer"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

              if (isset($_FILES["fitxer"]["name"]) && $_FILES["fitxer"]["name"] != '') {

                move_uploaded_file($_FILES["fitxer"]['tmp_name'], $target_file);
                $uploadOk = 1;
              } else {

                $uploadOk = 0;
              }
            }

            if (file_exists($_FILES["fitxer"]["name"])) {
              $xmlstr = simplexml_load_file($target_file);

              $correctes = 0;

              foreach ($xmlstr as $treballador) {

                $insert = "INSERT INTO treballadors (nom, cognom, data_naixement, antiguitat, id_rol) 
                VALUES ('" . $treballador->nom . "'," 
                ."'". $treballador->cognoms ."'". "," 
                ."'". $treballador->data_naixement ."'". "," 
                . $treballador->antiguitat . "," 
                . $treballador->codi_rol . ")";

                $resultat = mysqli_query($con, $insert);

                if (!$resultat) {
                  echo "<p>Error amb el treballador " . $treballador->nom ."   ". $insert . "    " . mysqli_error($con) . "</p>";
                } else {
                  $correctes += 1;
                }
              }
              echo $correctes . " Treballadors inserits correctament";
            } else {
              exit('ERROR LLEGIR XML');
            }
          }
          ?>
        </div>


            
          </div>
        </div>
      </div>
    </div>
  </body>
</html>