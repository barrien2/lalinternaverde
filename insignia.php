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
    //pujar imatge al servidor
    $target_dir = "uploads/";
    if (is_dir($target_dir)) {
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != '') {

        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if ($check !== false) {
          move_uploaded_file($_FILES["image"]['tmp_name'], $target_file);
          $uploadOk = 1;
        }
      } else {

        $uploadOk = 0;
      }
    }


    if ($_SESSION['rol'] > 1 && $_POST["action"] == "insert") {
      //inserir la insignia del formulari a bbdd
      $insert = "INSERT INTO insignies (nom, puntuacio, limit_insignies, imatge) VALUES ('" . $_POST['nom'] . "'," . $_POST['valor'] . "," . $_POST['limit'] . "," . "'" . $_FILES['image']['name'] . "')";
      $resultat = mysqli_query($con, $insert);
      if (!$resultat) {
        echo '<div class="uk-alert-danger" uk-alert>
                  <a class="uk-alert-close" uk-close></a>
                  <p> Error al inserir insignia, comprova que no existeixi una insignia amb el mateix nom</p>
              </div>
              ';
      } else {

        echo '<div class="uk-alert" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>Insignia ' . $_POST['nom'] . ' creada</p>
        <a class="uk-button uk-button-primary uk-button-small" href="insignies.php >Tornar a la llista</a>
    </div>
    ';
      }
    } else if ($_SESSION['rol'] > 1 && $_POST["action"] == "update") {
      $update = "UPDATE insignies SET nom = '" . $_POST['nom'] . "', puntuacio = " . $_POST['valor'] . ", limit_insignies = " . $_POST['limit'] . ", imatge =" . "'" . $_FILES['image']['name'] . "'" . " WHERE id = " . $_GET['id'];
      $resultat = mysqli_query($con, $update);
      if (!$resultat) {
        echo "<h1>Error</h1>";
      } else {
        echo '<div class="uk-alert" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p>Insignia ' . $_GET['id'] . ' modificada</p>
        <a class="uk-button uk-button-primary uk-button-small" href="insignies.php" >Tornar a la llista</a>
    </div>
   
    ';
      }
    }
  }

  //si tenim el id del registre en la url des del boto editar mostrem el formulari de editar
  if ($_SESSION['rol'] > 1 && $_SESSION['rol'] > 1 && isset($_GET['id']) && is_numeric($_GET['id']) && $resultado = mysqli_query($con, 'SELECT nom, puntuacio, limit_insignies, imatge FROM insignies WHERE id = ' . $_GET['id'])) {


    $fila = mysqli_fetch_assoc($resultado);

    ?>

    <div class="uk-flex-center uk-child-width-1-2@s uk-margin" uk-grid>
      <div>
        <div class="uk-card uk-card-default uk-card-body">


          <form method="post" enctype="multipart/form-data">
            <h4>Editar insignia</h4>

            <div class="uk-margin">
              <label class="uk-form-label" for="nom">Nom</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="nom" name="nom" type="text" value="<?php if (isset($fila['nom'])) echo $fila['nom'] ?>" placeholder="Nom">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="valor">Valor</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="valor" name="valor" type="number" value="<?php if (isset($fila['puntuacio'])) echo $fila['puntuacio'] ?>" placeholder="Puntuacio">
              </div>
            </div>

            <div class="uk-margin" uk-margin>
              <label class="uk-form-label" for="image">Imatge</label>
              <div uk-form-custom="target: true">
                <input type="file" name="image">
                <input class="uk-input uk-form-width-medium" type="text" placeholder="Selecciona una imatge" disabled>
              </div>
            </div>


            <div class="uk-margin">
              <label class="uk-form-label" for="limit">Limit</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="limit" name="limit" type="number" value="<?php if (isset($fila['limit_insignies'])) echo $fila['limit_insignies'] ?>" placeholder="Some text...">
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
            <h4>Nova insignia</h4>

            <div class="uk-margin">
              <label class="uk-form-label" for="nom">Nom</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="nom" name="nom" type="text" placeholder="Some text...">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="valor">Valor</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="valor" name="valor" type="number" placeholder="Some text...">
              </div>
            </div>

            <div class="uk-margin" uk-margin>
              <label class="uk-form-label" for="valor">Imatge</label>
              <div uk-form-custom="target: true">
                <input type="file" name="image">
                <input class="uk-input uk-form-width-medium" type="text" placeholder="Selecciona una imatge" disabled>
              </div>
            </div>


            <div class="uk-margin">
              <label class="uk-form-label" for="limit">Valor</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="limit" name="limit" type="number" placeholder="Some text...">
              </div>
            </div>


            <div class="uk-margin">
              <label class="uk-form-label" for="datalimit">Data limit</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="datalimit" name="datalimit" type="date" value="<?php echo date('Y-m-d'); ?>">
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