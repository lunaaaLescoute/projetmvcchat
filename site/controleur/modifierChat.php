<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.chat.inc.php";
include_once "$racine/modele/bd.couleurs.inc.php";
include_once "$racine/modele/bd.photos.inc.php";
include_once "$racine/modele/authentification.inc.php";

if (!isLoggedOn()) {
    require "$racine/vue/vueConnexion.php";
    exit();
}

$idC = $_GET['idC'] ?? null;

// Supprimer la photo
if (isset($_GET['action']) && $_GET['action'] === 'supprimerPhotoChat') {
    $photo = getPhotoByChat($idC);
    if ($photo) {
        unlink($photo['cheminPh']);
        $cnx = connexionPDO();
        $cnx->prepare("DELETE FROM photos WHERE chatID = :idC")->execute([':idC' => $idC]);
    }
    header('Location: index.php?action=modifierChat&idC=' . $idC);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateChat(
        $idC,
        $_POST['raceID'],
        $_POST['nomC'],
        $_POST['poidsC'],
        $_POST['tailleC'],
        $_POST['naissanceC'],
        $_POST['sexeC']
    );

    // Mettre à jour la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $anciennePhoto = getPhotoByChat($idC);
        if ($anciennePhoto) {
            unlink($anciennePhoto['cheminPh']);
            $cnx = connexionPDO();
            $cnx->prepare("DELETE FROM photos WHERE chatID = :idC")->execute([':idC' => $idC]);
        }
        $chemin = uploadPhoto($_FILES['photo']);
        if ($chemin) {
            addPhoto($chemin, $_FILES['photo']['name'], $idC);
        }
    }

    // Mettre à jour les couleurs
    $cnx = connexionPDO();
    $cnx->prepare("DELETE FROM couleurschat WHERE chatID = :idC")->execute([':idC' => $idC]);
    if (isset($_POST['couleurs'])) {
        foreach ($_POST['couleurs'] as $couleurID) {
            addCouleurChat($idC, $couleurID);
        }
    }

    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}

$chat = getChatById($idC);
$races = getRaces();
$couleurs = getCouleurs();
$couleursDuChat = getCouleursByChat($idC);
$photoChat = getPhotoByChat($idC);

require "$racine/vue/vueModifierChat.php";
?>