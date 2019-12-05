<?php
session_start();
if (isset($_SESSION["usuari"])) {
  session_destroy();
  session_unset();
  $_SESSION = [];
} else {
  if (isset($_POST['usuari']) && isset($_POST['passwd']) && canLogIn($_POST['usuari'], $_POST['passwd'])) {
    $_SESSION['usuari'] = $_POST['usuari'];
    header("Location: index.php");
    die();
  }
}
function canLogIn($user, $passwd)
{
  $result = false;

  require('bbdd.php');
  $query = "SELECT t.password as password, r.valor as rol FROM treballadors t INNER JOIN rols r on (t.id_rol = r.id) WHERE t.usuari = '$user'";

  if ($bbdd = mysqli_query($con, $query)) {
    $fila = mysqli_fetch_assoc($bbdd);

    $result = password_verify($passwd,  $fila['password']);
    if ($result) {
      $_SESSION['rol'] = $fila['rol'];
    }
  }

  return $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('csshead.php'); ?>
 
</head>

<body>
  <div id="head">
    <h2 class="uk-heading-line uk-text-center"><span>Intranet Login</span></h2>
  </div>
  <div class="uk-flex-center uk-child-width-1-4@s" uk-grid>
    <div>
      <div class="uk-card uk-card-default uk-card-body  uk-animation-shake">
        <form method="post" enctype="multipart/form-data">
          <div class="uk-margin">
            <input name="usuari" class="uk-input uk-form-width-medium" type="text" placeholder="Usuari">
          </div>
          <div class="uk-margin">
            <input name="passwd" class="uk-input uk-form-width-medium" type="password" placeholder="Contrasenya">
          </div>
          <div class="uk-margin">
            <input class="uk-button uk-button-primary" type="submit" value="entrar">
          </div>
        </form>
        <a href="createuser.php">No puc accedir</a>
      </div>
    </div>
  </div>
</body>

</html>