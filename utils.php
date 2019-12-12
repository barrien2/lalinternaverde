<?php
function canLogIn($user, $passwd)
{
  $result = false;

  require('bbdd.php');
  $passwd= md5($passwd);
  $query = "SELECT count(t.id) as count, r.valor as rol FROM treballadors t INNER JOIN rols r on (t.id_rol = r.id) WHERE t.usuari = '$user' and t.password = '$passwd'";

  if ($bbdd = mysqli_query($con, $query)) {
    $fila = mysqli_fetch_assoc($bbdd);

    $result = $fila['count'] == 1;
    if ($result) {
      $_SESSION['rol'] = $fila['rol'];
    }
  }else
  
  {
    echo '<div class="uk-alert-danger" uk-alert>
                  <a class="uk-alert-close" uk-close></a>
                  <p> Error base de dades: '.mysqli_error($con).'</p>
              </div>
              ';
  }

  return $result;
}
?>