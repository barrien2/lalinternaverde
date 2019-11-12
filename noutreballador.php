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

            <form action="insignies.php" method="post" enctype="multipart/form-data">
              <h4>Nou treballador</h4>

              <h6>Nom:</h6>
              <input type="text" name="nom" placeholder="nom insignia" required><br>

              <h6>Valor</h6>
              <input type="number" name="valor" value=0 required><br>

              <h6>Imatge:</h6>

              <input type="file" name="image"> <br>

              <h6>Limit</h6>
              <input type="number" name="limit" value=0 required><br>

              <h6>Data límit</h6>
              <input type="date" name="datalimit" value="<?php echo date('Y-m-d');?>" required><br>

              <h6>Descripcio</h6>
              <textarea type="textarea" name="descripcio" placeholder="no home no" required></textarea>

              <h6>Actiu</h6>
              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="actiu1">
                <input checked class="mdl-radio__button" id="actiu1" name="actiu" type="radio"
                value="si">
                <span class="mdl-radio__label">Si</span>
              </label>
              <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="actiu2">
                <input class="mdl-radio__button" id="actiu2" name="actiu" type="radio" value="no">
                <span class="mdl-radio__label">No</span>
              </label>
              <br/>
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