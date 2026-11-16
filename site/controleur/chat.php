<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.chat.inc.php";
include_once "$racine/modele/bd.couleurs.inc.php";
include_once "$racine/modele/authentification.inc.php";

if (!isLoggedOn()) {
    require "$racine/vue/vueConnexion.php";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mailU = getMailULoggedOn();
    $util  = getUtilisateurByMailU($mailU);
    
    $idC = addChat(
        $util['idU'],
        $_POST['raceID'],
        $_POST['nomC'],
        $_POST['poidsC'],
        $_POST['tailleC'],
        $_POST['naissanceC'],
        $_POST['sexeC']
    );

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        include_once "$racine/modele/bd.photos.inc.php";
        $chemin = uploadPhoto($_FILES['photo']);
        if ($chemin) {
            addPhoto($chemin, $_FILES['photo']['name'], $idC);
            }
    }
    
    if (isset($_POST['couleurs'])) {
        foreach ($_POST['couleurs'] as $couleurID) {
            addCouleurChat($idC, $couleurID);
        }
    }
    
    header('Location: index.php?action=meschats');
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'supprimerChat') {
    delChat($_GET['idC']);
    header('Location: index.php?action=meschats');
    exit();
}

$races = getRaces();
$couleurs = getCouleurs();
require "$racine/vue/vueAjouterChat.php";
?>