<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
    <title>Responsive Side Menu &ndash; Layout Examples &ndash; Pure</title>
    <?php include('csshead.php');require('bbdd.php'); ?>
</head>

<body>

    <h2 class="uk-heading-line uk-text-center"><span>Create admin user</span></h2>
    </div>
    <div class="uk-flex-center uk-child-width-1-4@s" uk-grid>
        <div>
            <?php
            if (isset($_POST['usuari']) && isset($_POST['passwd']) && isset($_POST['nom']) && !empty($_POST['usuari']) && !empty($_POST['passwd'])&& !empty($_POST['nom'])) {
                
                $encriptat = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
                
                $insert = "UPDATE treballadors t SET usuari = '".$_POST['nom']."', password = '".$encriptat."' WHERE id = ".$_POST['usuari'];
                $resultat = mysqli_query($con, $insert);
                
                if ($resultat) {
                    echo '<div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Treballador ' . $_POST['usuari'] . ' modificat correctament</p>
            </div>
            ';
                } else {
                    echo '<div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Error al crear el usuari: ' . mysqli_error($con). '</p>
            </div>
            ';
                }
            }

            ?>
            <div class="uk-card uk-card-default uk-card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="uk-margin">
                        <select name='usuari' class="uk-input uk-form-width-medium">
                            <?php
                            $consulta = "SELECT id, nom FROM treballadors";
                            if ($resultado = mysqli_query($con, $consulta)) {
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . $fila["id"] . "'>" . $fila["nom"] . "</option>";
                                }
                            } else {
                                echo "ERROR BBDD";
                            }
                            ?>

                        </select>

                    </div>
                    <div class="uk-margin">
                        <input name="nom" class="uk-input uk-form-width-medium" type="text" placeholder="Nom usuari" required>
                    </div>
                    <div class="uk-margin">
                        <input name="passwd" class="uk-input uk-form-width-medium" type="password" placeholder="Contrasenya" required>
                    </div>
                    
                    <div class="uk-margin">
                        <input class="uk-button uk-button-primary" type="submit" value="crear">
                    </div>
                    <a href="login.php">Entrar</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>