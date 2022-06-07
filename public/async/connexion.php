<?php
session_start();
$message = "Connexion impossible";
$success = false;
require_once "../../controllers/connexionTest.php";
$connex = new Connexion();

if ($_POST["identifiant"] && $_POST["password"]) {
    
    if ($connex->connexionForm($_POST["identifiant"] , $_POST["password"]) == true) {
        $success = true;
        $message = "Connexion réussi";
        $_SESSION["admin"] = true;
    }else {
        $success = false;
        $message = "Identifiant ou mot de passe invalide";
    }    
    
}else{
    echo "<script>document.location.href = '/'</script>";
    exit();
}

$return = ["success" => $success , "message" => $message];

echo json_encode($return);
