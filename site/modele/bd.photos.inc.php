<?php
include_once 'bd.inc.php';

function addPhoto($cheminPh, $nomPh, $chatID = null, $noteID = null, $commentaireID = null) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO photos (cheminPh, nomPh, dateAjoutPh, chatID, noteID, commentaireID) 
                          VALUES (:cheminPh, :nomPh, NOW(), :chatID, :noteID, :commentaireID)");
    $req->bindValue(':cheminPh', $cheminPh, PDO::PARAM_STR);
    $req->bindValue(':nomPh', $nomPh, PDO::PARAM_STR);
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->bindValue(':noteID', $noteID, PDO::PARAM_INT);
    $req->bindValue(':commentaireID', $commentaireID, PDO::PARAM_INT);
    return $req->execute();
}

function getPhotoByChat($chatID) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM photos WHERE chatID = :chatID");
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

function getPhotoByNote($noteID) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM photos WHERE noteID = :noteID");
    $req->bindValue(':noteID', $noteID, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

function getPhotoByCommentaire($commentaireID) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM photos WHERE commentaireID = :commentaireID");
    $req->bindValue(':commentaireID', $commentaireID, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

function uploadPhoto($fichier) {
    $dossier = dirname(__DIR__) . '/photos/'; // chemin absolu vers site/photos/
    $nomFichier = uniqid() . '_' . basename($fichier['name']);
    $cheminComplet = $dossier . $nomFichier;
    $cheminBD = 'photos/' . $nomFichier; // chemin relatif pour la BDD
    
    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($fichier['name'], PATHINFO_EXTENSION));
    
    if (!in_array($extension, $extensionsAutorisees)) {
        return null;
    }
    
    if (move_uploaded_file($fichier['tmp_name'], $cheminComplet)) {
        return $cheminBD; // retourne le chemin relatif pour la BDD
    }
    
    return null;
}
?>