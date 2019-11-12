<?php
include("bbdd.php");
require('autenticador.php');

?>
<html>

<head>
  <title>ARASI</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <style>
    table {
      border-collapse: collapse;
      width: 80%;
      align: center;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    .centerTable {
      margin: 20px auto;
    }
  </style>
</head>

<body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <?php
    include("header.php");
    ?>
    <main class="mdl-layout__content">
      <div class="page-content">
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
    </main>
  </div>
</body>

</html>