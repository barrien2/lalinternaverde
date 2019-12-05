<?php
require('autenticador.php');
include("bbdd.php");


?>

<html>

<head>

  <?php include('csshead.php'); ?>
</head>


<body>

  <div class="uk-content">
    <?php
    include("header.php");
    ?>
    <main class="mdl-layout__content">
      <div class="page-content">
        <div>
          <table class="uk-table uk-table-striped">
            <thead>
              <tr>
                <th>Imatge</th>
                <th>nom</th>
                <th>Maxim</th>
                <th>Otorgades</th>
                <th>Valor</th>
              </tr>
            </thead>
            <?php
            $consulta = "SELECT i.id as id,
             i.nom as nom, i.limit_insignies, COUNT(ti.id) as otorgades, i.puntuacio, i.imatge
                FROM insignies i 
                LEFT JOIN treballadors_insignies ti on (ti.id_insignia = i.id)
                GROUP by i.id
                ";
            if ($resultado = mysqli_query($con, $consulta)) {
              while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                if (!empty($fila["imatge"])) {
                  echo "<td>" . ' <img src = "uploads/' . $fila["imatge"] . '" width="50">';
                } else {
                  echo "<td> </td>";
                }
                echo "<td>" . $fila["nom"] . "</td>";
                echo "<td>" . $fila["limit_insignies"] . "</td>";
                echo "<td>" . $fila["otorgades"] . "</td>";
                echo "<td>" . $fila["puntuacio"] . "</td>";
                ?>
                <td>
                  <div class="uk-margin-small">
                    <div class="uk-button-group">
                      <?php if ($_SESSION['rol'] > 1) { ?>
                      <a class="uk-button uk-button-primary uk-button-small" href="insignia.php?<?php echo http_build_query(array(
                                                                                                      'id' => $fila['id']
                                                                                                    )) ?>">Editar</a>
                                                                                                    <?php }
                  if ($_SESSION['rol'] > 2) { ?>
                      <a class="uk-button uk-button-danger uk-button-small" href="delete.php?<?php echo http_build_query(array(
                                                                                                    'table' => 'insignies',
                                                                                                    'id' => $fila['id'],
                                                                                                    'name' => $fila['nom'],
                                                                                                    'paginaOrigen' => 'insignies.php'
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
      </div>
    </main>
  </div>
</body>

</html>