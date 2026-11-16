<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.suivisante.inc.php";
include_once "$racine/modele/authentification.inc.php";

if (!isLoggedOn()) {
    require "$racine/vue/vueConnexion.php";
    exit();
}

$idC = $_GET['idC'] ?? $_POST['idC'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addSuivi($idC, $_POST['poidsSS'], $_POST['tailleSS'], $_POST['dateSS'], $_POST['commentaireSS']);
    include_once "$racine/modele/bd.chat.inc.php";
    updatePoidsEtTaille($idC, $_POST['poidsSS'], $_POST['tailleSS']);
    
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}

require "$racine/vue/vueAjouterSuivi.php";
?>