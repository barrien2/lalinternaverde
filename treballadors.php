<?php

require('autenticador.php');
include("bbdd.php");

?>
<html>

<head>
  <title>ARASI</title>
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

    $consulta = "SELECT concat(t.nom,' ',t.cognom) as treballador, count(ti.id) as insignies, sum(i.puntuacio) as puntuacio
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

        echo "</tr>";
      }
    } else {
      echo "ERROR CONNCECTION";
    }
    ?>
  </table>
</div>

</html>