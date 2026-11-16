<?php
include_once 'bd.inc.php';

function getCouleurs() {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM couleurs");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getCouleursByChat($idC) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT couleurs.* FROM couleurs 
                          JOIN couleurschat ON couleurs.idCo = couleurschat.couleurID 
                          WHERE couleurschat.chatID = :idC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function addCouleurChat($chatID, $couleurID) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO couleurschat (chatID, couleurID) 
                          VALUES (:chatID, :couleurID)");
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->bindValue(':couleurID', $couleurID, PDO::PARAM_INT);
    return $req->execute();
}

function delCouleurChat($chatID, $couleurID) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("DELETE FROM couleurschat 
                          WHERE chatID = :chatID AND couleurID = :couleurID");
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->bindValue(':couleurID', $couleurID, PDO::PARAM_INT);
    return $req->execute();
}
?>