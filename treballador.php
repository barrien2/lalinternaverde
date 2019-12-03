<?php
require('autenticador.php');
require('bbdd.php');
//comprovar que s'ha enviat desde el formulari de inserir



?>
<html>

<head>
  <title>ARASI</title>
  <?php

  include('csshead.php');

  ?>

</head>

<body>

  <?php
  include("header.php");


  if (isset($_POST["action"])) {
    $encriptat = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($_SESSION['rol'] > 1 && $_POST["action"] == "insert") {
      //inserir la insignia del formulari a bbdd
      $insert = "INSERT INTO treballadors (id_rol, nom, cognom, edat, antiguitat, data_naixement, usuari, password) VALUES (" . $_POST['id_rol'] . ",'" . $_POST['nom'] . "','" . $_POST['cognom'] . "'," . $_POST['edat'] . "," .  $_POST['antiguitat'] . ",'" .  $_POST['data_naixement'] . "','" .  $_POST['usuari'] . "','" .  $encriptat .  "')";
      $resultat = mysqli_query($con, $insert);
      if (!$resultat) {
        echo '<div class="uk-alert-danger" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p> Error al inserir treballador, comprova que no existeixi un treballador amb el mateix nom' . mysqli_error($con) . '</p>
        </div>
        ';
      } else {

        echo '
        <div class="uk-alert" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p>Treballador ' . $_POST['nom'] . ' creat</p>
          <a class="uk-button uk-button-primary uk-button-small" href="treballadors.php" >Tornar a la llista</a>
        </div>
        ';
      }
    } else if ($_POST["action"] == "update" && $_SESSION['rol'] > 1) {

      if (isset($_POST["id_rol"])) {
        $update = "UPDATE treballadors SET id_rol = " . $_POST['id_rol'] . ", nom = '" . $_POST['nom'] . "', cognom = '" . $_POST['cognom'] . "', edat = " . $_POST['edat'] . ", antiguitat = " . $_POST['antiguitat'] . ", data_naixement = '" . $_POST['data_naixement'] . "', usuari = '" . $_POST['usuari'] . "', password = '" . $encriptat . "' WHERE id = " . $_GET['id'];
      } else {
        $update = "UPDATE treballadors SET nom = '" . $_POST['nom'] . "', cognom = '" . $_POST['cognom'] . "', edat = " . $_POST['edat'] . ", antiguitat = " . $_POST['antiguitat'] . ", data_naixement = '" . $_POST['data_naixement'] . "', usuari = '" . $_POST['usuari'] . "', password = '" . $encriptat . "' WHERE id = " . $_GET['id'];
      }


      $resultat = mysqli_query($con, $update);
      if (!$resultat) {
        echo "<h1>Error</h1>";
      } else {
        echo '
        <div class="uk-alert" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p>Treballador ' . $_POST['nom'] . ' editat</p>
          <a class="uk-button uk-button-primary uk-button-small" href="treballadors.php" >Tornar a la llista</a>
        </div>
        ';
      }
    }
  }

  //si tenim el id del registre en la url des del boto editar mostrem el formulari de editar
  if ($_SESSION['rol'] > 1 && isset($_GET['id']) && is_numeric($_GET['id']) && $resultado = mysqli_query($con, 'SELECT id_rol, nom, cognom, edat, antiguitat, data_naixement, usuari FROM treballadors WHERE id = ' . $_GET['id'])) {


    $fila = mysqli_fetch_assoc($resultado);

    ?>

    <div class="uk-flex-center uk-child-width-1-2@s uk-margin" uk-grid>
      <div>
        <div class="uk-card uk-card-default uk-card-body">


          <form method="post" enctype="multipart/form-data">
            <h4>Editar treballador</h4>

            <?php
              if ($_SESSION['rol'] > 2) { ?>
              <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-select">Rol</label>
                <div class="uk-form-controls">
                  <select class="uk-select" id="form-stacked-select" name="id_rol">
                    <?php
                        $consulta = "SELECT id, nom FROM rols";
                        if ($resultado = mysqli_query($con, $consulta)) {
                          while ($filaRols = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $filaRols["id"] . "'>" . $filaRols["nom"] . "</option>";
                          }
                        } else {
                          echo "ERROR BBDD";
                        } ?>
                  </select>
                </div>
              </div>

            <?php } ?>

            <div class="uk-margin">
              <label class="uk-form-label" for="nom">Nom</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="nom" name="nom" type="text" value="<?php if (isset($fila['nom'])) echo $fila['nom'] ?>" placeholder="Nom">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="cognom">cognom</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="cognom" name="cognom" type="text" value="<?php if (isset($fila['cognom'])) echo $fila['cognom'] ?>" placeholder="cognom">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="edat">Edat</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="edat" name="edat" type="number" value="<?php if (isset($fila['edat'])) echo $fila['edat'] ?>" placeholder="Edat">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="antiguitat">Antiguitat</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="antiguitat" name="antiguitat" type="number" value="<?php if (isset($fila['antiguitat'])) echo $fila['antiguitat'] ?>" placeholder="Antiguitat">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="data_naixement">Data naixement</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="data_naixement" name="data_naixement" type="date" value="<?php if (isset($fila['data_naixement'])) echo $fila['data_naixement'] ?>" placeholder="data_naixement">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="usuari">Usuari</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="usuari" name="usuari" type="text" value="<?php if (isset($fila['usuari'])) echo $fila['usuari'] ?>" placeholder="Usuari">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="password">Contrasenya</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="password" name="password" type="password" value="<?php if (isset($fila['password'])) echo $fila['password'] ?>" placeholder="Contrasenya">
              </div>
            </div>



        </div>
        <input type="submit" value="Guardar" class="uk-button uk-button-primary">
        <input type="reset" value="Esborrar" class="uk-button uk-button-danger uk-align-right"><br>
        <input type="hidden" name="action" value="update">
        </form>
      </div>
    </div>
    </div>
  <?php
  }
  //sino tenim el id mostrem el formulari de nova insignia
  else {
    ?>
    <div class="uk-flex-center uk-child-width-1-2@s uk-margin" uk-grid>
      <div>
        <div class="uk-card uk-card-default uk-card-body">


          <form method="post" enctype="multipart/form-data">
            <h4>Nou treballador</h4>

            <div class="uk-margin">
              <label class="uk-form-label" for="form-stacked-select">Rol</label>
              <div class="uk-form-controls">
                <select class="uk-select" id="form-stacked-select" name="id_rol">
                  <?php
                    $consulta = "SELECT id, nom FROM rols";
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
              <label class="uk-form-label" for="nom">Nom</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="nom" name="nom" type="text" placeholder="Nom">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="cognom">cognom</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="cognom" name="cognom" type="text" placeholder="cognom">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="edat">Edat</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="edat" name="edat" type="number" placeholder="Edat">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="antiguitat">Antiguitat</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="antiguitat" name="antiguitat" type="number" placeholder="Antiguitat">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="data_naixement">Data naixement</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="data_naixement" name="data_naixement" type="date" placeholder="data_naixement">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="usuari">Usuari</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="usuari" name="usuari" type="text" placeholder="Usuari">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="password">Contrasenya</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="password" name="password" type="password" placeholder="Contrasenya">
              </div>
            </div>

            <input type="submit" value="Crear" class="uk-button uk-button-primary">
            <input type="reset" value="Esborrar" class="uk-button uk-button-danger uk-align-right"><br>
            <input type="hidden" name="action" value="insert">
          </form>
        </div>
      </div>
    </div>



  <?php } ?>
</body>

</html>