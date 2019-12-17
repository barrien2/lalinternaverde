<?php

require('autenticador.php');
include("bbdd.php");

?>
<html>

<head>

  <?php include('csshead.php'); ?>
</head>


<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <?php
  include("header.php");
  ?>
  <table class="uk-table uk-table-striped">

    <div class="uk-sticky">
      <thead class="tablehead">
        <tr>
          <th>Treballador</th>
          <th># Insignies</th>
          <th>Puntuació total</th>
        </tr>
      </thead>
    </div>
    <?php

    $consulta = "SELECT t.id as id, concat(t.nom,' ',t.cognom) as treballador, count(ti.id) as insignies, sum(i.puntuacio) as puntuacio, t.usuari as usuari
        FROM treballadors t
        LEFT JOIN treballadors_insignies ti on (ti.id_treballador = t.id)
        LEFT JOIN insignies i on (ti.id_insignia = i.id)
        GROUP BY t.id
        ORDER BY count(ti.id) desc, sum(i.puntuacio) desc";
    if ($resultado = mysqli_query($con, $consulta)) {
      while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $fila["treballador"] . "</td>";
        echo "<td>" . $fila["insignies"] . "</td>";
        echo "<td>" . $fila["puntuacio"] . "</td>";

        ?>
        <td>
          <div class="uk-margin-small">
            <div class="uk-button-group">
              <?php if ($_SESSION['rol'] > 1) { ?>
                <a class="uk-button uk-button-primary uk-button-small" href="treballador.php?<?php echo http_build_query(array(
                                                                                                      'id' => $fila['id']
                                                                                                    )) ?>">Editar</a>
              <?php }
                  if ($_SESSION['rol'] > 2 && $_SESSION['usuari'] != $fila['usuari']) { ?>
                <a class="uk-button uk-button-danger uk-button-small" href="delete.php?<?php echo http_build_query(array(
                                                                                                'table' => 'treballadors',
                                                                                                'id' => $fila['id'],
                                                                                                'name' => $fila['treballador'],
                                                                                                'paginaOrigen' => 'treballadors.php'
                                                                                              )) ?>">Esborrar</a>
              <?php } ?>
            </div>
          </div>
        </td>
    <?php





        echo "</tr>";
      }
    } else {
      echo "ERROR CONNCECTION";
    }
    ?>
  </table>
</div>

</html>