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

<body>

  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <?php
    include("header.php");
    ?>
    <main class="mdl-layout__content">
      <div class="page-content">
        <div>

          <?php
          include("bbdd.php");

          //comprovar que s'ha enviat desde el formulari de inserir
          if (isset($_POST["action"]) && $_POST["action"] == "insert") {
            //pujar imatge al servidor
            $target_dir = "uploads/";
            if (is_dir($target_dir)) {
              $target_file = $target_dir . basename($_FILES["fitxer"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

              if (isset($_FILES["fitxer"]["name"]) && $_FILES["fitxer"]["name"] != '') {

                move_uploaded_file($_FILES["fitxer"]['tmp_name'], $target_file);
                $uploadOk = 1;
              } else {

                $uploadOk = 0;
              }
            }

            if (file_exists($_FILES["fitxer"]["name"])) {
              $xmlstr = simplexml_load_file($target_file);

              $correctes = 0;

              foreach ($xmlstr as $treballador) {

                $insert = "INSERT INTO treballadors (nom, cognom, data_naixement, antiguitat, id_rol) 
                VALUES ('" . $treballador->nom . "'," 
                ."'". $treballador->cognoms ."'". "," 
                ."'". $treballador->data_naixement ."'". "," 
                . $treballador->antiguitat . "," 
                . $treballador->codi_rol . ")";

                $resultat = mysqli_query($con, $insert);

                if (!$resultat) {
                  echo "<p>Error amb el treballador " . $treballador->nom ."   ". $insert . "    " . mysqli_error($con) . "</p>";
                } else {
                  $correctes += 1;
                }
              }
              echo $correctes . " Treballadors inserits correctament";
            } else {
              exit('ERROR LLEGIR XML');
            }
          }
          ?>
        </div>
      </div>
    </main>
  </div>
</body>

</html>