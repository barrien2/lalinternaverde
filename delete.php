<?php require('autenticador.php');
require('utils.php');
require('bbdd.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">

    <?php include('csshead.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>
    <?php

    if ($_SESSION['rol'] > 2 && isset($_GET['table']) && isset($_GET['id'])) {

        if (isset($_POST['sure']) && $_POST['sure'] == 'yes') {
            $err = delete($_GET['id'], $_GET['table']);
            if (!empty($err)) {
                echo '<div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p> Error :( ' . $err . '</p>
            </div>
            ';
            } else {
                echo '<div class="uk-alert" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Registre '.$_GET['table'].' '.$_GET['name'].'('.$_GET['id']. ') borrat</p>
                <a class="uk-button uk-button-primary uk-button-small" href="'.$_GET['paginaOrigen'].'" >Tornar a la llista</a>
            </div>
            ';
            }
        } else {

            ?>
            <h1>Segur que vols borrar el registre <?php if (isset($_GET['name'])) echo $_GET['name']; ?> ?</h1>
            <a class="uk-button uk-button-primary uk-margin" href="index.php">NO :/</a>
            <form method="post"><input type="hidden" name="sure" value="yes"><input class="uk-button uk-button-danger uk-margin" href="" type="submit" value="si home si"></input></form>
    <?php
        }
    } else {
        echo '<div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>Queisieron</p>
            </div>
            ';
    }


    ?>
</body>

</html>

<?php



function delete($id, $table)
{
    require('bbdd.php');
    $sql = "DELETE FROM $table WHERE id = $id";
    if (!mysqli_query($con, $sql)) {
        return mysqli_error($con);
    }
}

?>