<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">

    <?php include('csshead.php');
    require('bbdd.php'); ?>
</head>

<body>

    <h2 class="uk-heading-line uk-text-center"><span>Canviar contrasenya</span></h2>
    </div>
    <div class="uk-flex-center uk-child-width-1-4@s" uk-grid>
        <div>
            <?php
            if (isset($_POST['usuari']) && isset($_POST['passwd']) && isset($_POST['newpasswd']) && !empty($_POST['usuari']) && !empty($_POST['passwd']) && !empty($_POST['newpasswd']) ) {


                require('utils.php');
                //comprovar que el usuari i contrasenya son correctes
                if (canLogIn($_POST['usuari'], $_POST['passwd'])) {

                    //si es correcte actualitzem la contrasenya
                    $encriptat = md5($_POST['newpasswd']);

                    $insert = "UPDATE treballadors t SET password = '" . $encriptat . "' WHERE usuari = '" . $_POST['usuari']."'";
                    $resultat = mysqli_query($con, $insert);

                    if ($resultat) {
                        echo '<div class="uk-alert-success" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>Usuari ' . $_POST['usuari'] . ' modificat correctament</p>
                        </div>
                        ';
                    } else {
                        echo '<div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>Error al modificar el usuari: ' . mysqli_error($con) .' '.$insert. '</p>
                        </div>
                        ';
                    }
                }else{
                    echo '<div class="uk-alert-danger" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>Credencials incorrectes</p>
                        </div>
                        ';
                }
            }

            ?>
            <div class="uk-card uk-card-default uk-card-body">
                <form method="post" enctype="multipart/form-data">





                <div class="uk-margin">
              <label class="uk-form-label" for="usuari">Usuari</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="usuari" name="usuari" type="text" placeholder="Usuari">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="passwd">Contrasenya actual</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="passwd" name="passwd" type="password" placeholder="Contrasenya actual">
              </div>
            </div>

            <div class="uk-margin">
              <label class="uk-form-label" for="newpasswd">Nova contrasenya</label>
              <div class="uk-form-controls">
                <input class="uk-input" id="newpasswd" name="newpasswd" type="password" placeholder="Nova contrasenya">
              </div>
            </div>


                    <div class="uk-margin">
                        <input class="uk-button uk-button-primary" type="submit" value="Canviar">
                    </div>
                    <a href="login.php">Entrar</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>