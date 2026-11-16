<?php
include_once 'bd.inc.php';

function getCommentaires() {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT commentaire.*, utilisateur.pseudoU 
                          FROM commentaire 
                          JOIN utilisateur ON commentaire.userID = utilisateur.idU
                          ORDER BY datePublicationCom DESC");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function addCommentaire($userID, $texteCom) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO commentaire (userID, texteCom, datePublicationCom) 
                          VALUES (:userID, :texteCom, NOW())");
    $req->bindValue(':userID', $userID, PDO::PARAM_INT);
    $req->bindValue(':texteCom', $texteCom, PDO::PARAM_STR);
    return $req->execute();
}

function delCommentaire($idCom) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("DELETE FROM commentaire WHERE idCom = :idCom");
    $req->bindValue(':idCom', $idCom, PDO::PARAM_INT);
    return $req->execute();
}
?>