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
  <title>ARASI</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
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

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <?php
  include("header.php");
  ?>
  <table class="centerTable" style="overflow-x:auto;">
    <tr>
      <th>Insignia</th>
      <th>Treballadors</th>
      <th>Data</th>
    </tr>
    <?php

//si venim del form de insert o del de consulta sense seleccionar treballador
    if ((isset($_POST["action"]) && $_POST["action"] == "insert") || (isset($_POST["action"]) && $_POST["action"] == "filter"  && isset($_POST["treballador"]) && $_POST["treballador"] == "*tots*") ) {
      $consulta = "SELECT t.nom as treballador, i.nom as insignia, ti.data_otorgat as data_otorgat FROM treballadors_insignies ti
                    INNER JOIN treballadors t on (ti.id_treballador = t.id)
                    INNER JOIN insignies i on (ti.id_insignia = i.id);";
      if ($resultado = mysqli_query($con, $consulta)) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
          echo "<tr>";
          echo "<td>" . $fila["insignia"] . "</td>";
          echo "<td>" . $fila["treballador"] . "</td>";
          echo "<td>" . $fila["data_otorgat"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "ERROR DE BBDD";
      }
    } else if (isset($_POST["action"]) && $_POST["action"] == "filter"  && isset($_POST["treballador"])) {
      $consulta = "SELECT t.nom as treballador, i.nom as insignia, ti.data_otorgat as data_otorgat FROM treballadors_insignies ti
      INNER JOIN treballadors t on (ti.id_treballador = t.id)
      INNER JOIN insignies i on (ti.id_insignia = i.id)
      WHERE ti.id_treballador = ".$_POST['treballador'].";";
      if ($resultado = mysqli_query($con, $consulta)) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
          echo "<tr>";
          echo "<td>" . $fila["insignia"] . "</td>";
          echo "<td>" . $fila["treballador"] . "</td>";
          echo "<td>" . $fila["data_otorgat"] . "</td>";
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