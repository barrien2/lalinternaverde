<?php 
$usuari = "";
$rolUsuari = 0;

session_start();

if(!isset($_SESSION['usuari'])){

   if(isset($_POST['usuari']) && isset($_POST['passwd'])){
        $_SESSION['usuari'] = $_POST['usuari'];
   }
   else{
    header("Location: login.php");
    die();
   } 
}

?>