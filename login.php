<?

session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="centerTable">

<form action="index.php" method="post" enctype="multipart/form-data">
  <h4>Inici sessió</h4>

  <h6>Nom:</h6>
  <input type="text" name="usuari" placeholder="nom insignia" required><br>

  <h6>Cotrasenya:</h6>
  <input type="password" name="passwd" value=0 required><br>


  <input type="submit" value="Entrar" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"><br>
  <input type="reset" value="Esborrar" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"><br>
</form>
</div>
</body>
</html>