<?php
require('autenticador.php');
include("bbdd.php");

if (isset($_POST["action"]) && $_POST["action"] == "insert" && isset($_POST["treballadors"]) && isset($_POST["insignia"])) {

  $treballadors = $_POST['treballadors'];


  $queryCount = "SELECT count(ti.id) as count FROM treballadors_insignies ti WHERE ti.id_insignia =" . $_POST['insignia'];
  $count = 0;
  if ($bbddCount = mysqli_query($con, $queryCount)) {
    $filaCount = mysqli_fetch_assoc($bbddCount);

    $count = $filaCount['count'];


    $querylimiti = "SELECT limit_insignies as count FROM insignies i WHERE i.id =" . $_POST['insignia'];
    $limiti = 0;
    if ($bbddlimti = mysqli_query($con, $querylimiti)) {
      $filalimiti = mysqli_fetch_assoc($bbddlimti);

      $limiti = $filalimiti['count'];

      if ($limiti > $count) {
        for ($i = 0; $i < count($treballadors); $i++) {
          $insert = "INSERT INTO treballadors_insignies (id_insignia, id_treballador) VALUES (" . $_POST['insignia'] . "," . $treballadors[$i] . ")";
          $resultat = mysqli_query($con, $insert);
        }
      } else {

        $querynom = 'SELECT nom FROM insignies WHERE id = ' . $_POST['insignia'];
        $nom = "";
        if ($bbddnom = mysqli_query($con, $querynom)) {
          $filanom = mysqli_fetch_assoc($bbddnom);
          $nom = $filanom['nom'];
        }

        echo "<h1>Ha arribat al limit de atorgaments  (" . $limiti . ")"." de la insignia " . $nom ." </h1><p>" . mysqli_error($con) . "</p>";
      }
    }
  }
}

?>

<html>

<head>

  <?php
  include('csshead.php');
  ?>
</head>


<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <?php
  include("header.php");
  ?>
  <table class="uk-table uk-table-striped">
    <thead>
      <tr>
        <th>Insignia</th>
        <th>Treballadors</th>
        <th>Data</th>
      </tr>
    </thead>
    <?php

    //si venim del form de insert o del de consulta sense seleccionar treballador
    if ((isset($_POST["action"]) && $_POST["action"] == "insert") || (isset($_POST["action"]) && $_POST["action"] == "filter"  && isset($_POST["treballador"]) && $_POST["treballador"] == "*tots*")) {
      $consulta = "SELECT ti.id as id, t.nom as treballador, i.nom as insignia, ti.data_otorgat as data_otorgat FROM treballadors_insignies ti
                    INNER JOIN treballadors t on (ti.id_treballador = t.id)
                    INNER JOIN insignies i on (ti.id_insignia = i.id);";
      if ($resultado = mysqli_query($con, $consulta)) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
          echo "<tr>";
          echo "<td>" . $fila["insignia"] . "</td>";
          echo "<td>" . $fila["treballador"] . "</td>";
          echo "<td>" . $fila["data_otorgat"] . "</td>";

    ?>
          <td>
            <div class="uk-margin-small">
              <div class="uk-button-group">
                <a class="uk-button uk-button-danger uk-button-small" href="delete.php?<?php echo http_build_query(array(
                                                                                          'table' => 'treballadors_insignies',
                                                                                          'id' => $fila['id'],
                                                                                          'name' => 'Atorgació treballador: '. $fila['treballador'] . ' insignia: '.$fila["insignia"],
                                                                                          'paginaOrigen' => 'consultaratorgades.php'
                                                                                        )) ?>">Desasignar</a>
              </div>
            </div>
          </td>
        <?php

                                                                                        echo "</tr>";
                                                                                      }
                                                                                    } else {
                                                                                      echo "ERROR DE BBDD";
                                                                                    }
                                                                                  } else if (isset($_POST["action"]) && $_POST["action"] == "filter"  && isset($_POST["treballador"])) {
                                                                                    $consulta = "SELECT ti.id as id, t.nom as treballador, i.nom as insignia, ti.data_otorgat as data_otorgat FROM treballadors_insignies ti
      INNER JOIN treballadors t on (ti.id_treballador = t.id)
      INNER JOIN insignies i on (ti.id_insignia = i.id)
      WHERE ti.id_treballador = " . $_POST['treballador'] . ";";
                                                                                    if ($resultado = mysqli_query($con, $consulta)) {
                                                                                      while ($fila = mysqli_fetch_assoc($resultado)) {
                                                                                        echo "<tr>";
                                                                                        echo "<td>" . $fila["insignia"] . "</td>";
                                                                                        echo "<td>" . $fila["treballador"] . "</td>";
                                                                                        echo "<td>" . $fila["data_otorgat"] . "</td>";

        ?>
          <td>
            <div class="uk-margin-small">
              <div class="uk-button-group">


                <a class="uk-button uk-button-danger uk-button-small" href="delete.php?<?php echo http_build_query(array(
                                                                                          'table' => 'treballadors_insignies',
                                                                                          'id' => $fila['id'],
                                                                                          'name' => $fila['treballador'],
                                                                                          'paginaOrigen' => 'consultaratorgades.php'
                                                                                        )) ?>">Desasignar</a>
              </div>
            </div>
          </td>
    <?php

                                                                                        echo "</tr>";
                                                                                      }
                                                                                    } else {
                                                                                      echo "ERROR DE BBDD";
                                                                                    }
                                                                                  }
    ?>
  </table>
</div>

</html>