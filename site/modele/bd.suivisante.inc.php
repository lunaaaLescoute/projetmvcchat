<?php
include_once 'bd.inc.php';

function getSuiviByChat($idC) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT suivisante.*
                          FROM suivisante
                          WHERE chatID = :idC
                          ORDER BY dateSS DESC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function addSuivi($chatID, $poidsSS, $tailleSS, $dateSS, $commentaireSS) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO suivisante (chatID, poidsSS, tailleSS, dateSS, commentaireSS) 
                          VALUES (:chatID, :poidsSS, :tailleSS, :dateSS, :commentaireSS)");
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->bindValue(':poidsSS', $poidsSS, PDO::PARAM_STR);
    $req->bindValue(':tailleSS', $tailleSS, PDO::PARAM_STR);
    $req->bindValue(':dateSS', $dateSS, PDO::PARAM_STR);
    $req->bindValue(':commentaireSS', $commentaireSS, PDO::PARAM_STR);
    return $req->execute();
}

function delSuivi($idSS) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("DELETE FROM suivisante WHERE idSS = :idSS");
    $req->bindValue(':idSS', $idSS, PDO::PARAM_INT);
    return $req->execute();
}
?>