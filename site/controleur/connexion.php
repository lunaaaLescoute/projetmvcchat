<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.inc.php";

if (isset($_POST["mailU"]) && isset($_POST["mdpU"])) {
    $mailU = $_POST["mailU"];
    $mdpU  = $_POST["mdpU"];
} else {
    $mailU = "";
    $mdpU  = "";
}

login($mailU, $mdpU);

if (isLoggedOn()) {
    header('Location: index.php?action=meschats');
    exit();
} else {
    require "$racine/vue/vueConnexion.php";
}
?>