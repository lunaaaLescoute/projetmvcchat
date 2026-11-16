<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.notes.inc.php";
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.photos.inc.php";

if (!isLoggedOn()) {
    require "$racine/vue/vueConnexion.php";
    exit();
}

$idC = $_GET['idC'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNote = addNote($idC, $_POST['contenuN']); // ← récupère l'id
    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $chemin = uploadPhoto($_FILES['photo']);
        if ($chemin) {
            addPhoto($chemin, $_FILES['photo']['name'], null, $idNote);
        }
    }
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}

require "$racine/vue/vueAjouterNotes.php";
?>