<?php 

require('autenticador.php');

?>
<html>
<head>
  <title>ARASI</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <style>

    .centerTable { margin: 10px; background-color:#E3F2FD; padding:10px; width:300px;}

  </style>
</head>
  
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <?php
        include("header.php");
      ?>
      <main class="mdl-layout__content">
        <div class="page-content">
          <div class="centerTable">

            <form action="scripttreballadors.php" method="post" enctype="multipart/form-data">
              <h4>Inserir treballadors</h4>

              

              <h6>Fitxer xml</h6>

              <input type="file" name="fitxer"> <br>

            
              <input type="submit" value="Enviar dades" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"><br>
              <input type="reset" value="Esborrar" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect"><br>
              <input type="hidden" name="action" value="insert">
            </form>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>