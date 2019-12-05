<?php
require('autenticador.php');
include("bbdd.php");

if (isset($_POST["action"]) && $_POST["action"] == "insert") {

  $treballadors = $_POST['treballadors'];


  for ($i = 0; $i < count($treballadors); $i++) {
    $insert = "INSERT INTO treballadors_insignies (id_insignia, id_treballador) VALUES (" . $_POST['insignia'] . "," . $treballadors[$i] . ")";
    $resultat = mysqli_query($con, $insert);
  }

  if (!$resultat) {
    echo "<h1>Insignia ja atorgada a un o varis treballadors: </h1>";
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