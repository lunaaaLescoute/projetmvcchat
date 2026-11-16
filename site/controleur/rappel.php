<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.rappel.inc.php";
include_once "$racine/modele/authentification.inc.php";

if (!isLoggedOn()) {
    require "$racine/vue/vueConnexion.php";
    exit();
}

$idC = $_GET['idC'] ?? $_POST['idC'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addRappel($idC, $_POST['typeRap'], $_POST['timeRap'], $_POST['descriptionRap'], $_POST['recurrenceRap']);
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}

require "$racine/vue/vueAjouterRappel.php";
?>