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

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
.centerTable { margin: 20px auto; }

</style>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <?php
    include("header.php");
    ?>
  <table class="centerTable" style="overflow-x:auto;">
      <tr>
        <th>Treballador</th>
        <th># Insignies</th>
        <th>Puntuació total</th>
      </tr>
      <?php
      include ("bbdd.php");
        $consulta = "SELECT concat(t.nom,' ',t.cognom) as treballador, count(ti.id) as insignies, sum(i.puntuacio) as puntuacio
        FROM treballadors t
        LEFT JOIN treballadors_insignies ti on (ti.id_treballador = t.id)
        LEFT JOIN insignies i on (ti.id_insignia = i.id)
        GROUP BY t.id
        ORDER BY count(ti.id) desc, sum(i.puntuacio) desc";
                  if ($resultado = mysqli_query($con, $consulta)) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                      echo "<tr>";
                      echo "<td>".$fila["treballador"]."</td>";         
                      echo "<td>".$fila["insignies"]."</td>";
                      echo "<td>".$fila["puntuacio"]."</td>";
                      echo "</tr>";
                    }
                  }else{
                    echo "ERROR CONNCECTION";
                  } 
      ?>
  </table>
</div>
</html>