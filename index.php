<?php
include("bbdd.php");
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
        <h1>L'empleat d'aquest més és:
          <?php
          $consulta = "SELECT concat(t.nom,' ',t.cognom) as treballador, count(ti.id) as insignies, sum(i.puntuacio) as puntuacio
                  FROM treballadors t
                  INNER JOIN treballadors_insignies ti on (ti.id_treballador = t.id)
                  INNER JOIN insignies i on (ti.id_insignia = i.id)
                  GROUP BY t.id
                  ORDER BY sum(i.puntuacio) desc 
                  limit 1";
          if ($resultado = mysqli_query($con, $consulta)) {
            $fila = mysqli_fetch_assoc($resultado);
            echo $fila["treballador"];
          } else {
            echo "ERROR CONNCECTION";
          }
          ?>
        </h1>
      </div>

</body>

</html>