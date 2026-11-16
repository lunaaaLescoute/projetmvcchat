<?php
include_once 'bd.inc.php';

function getNotesByChat($idC) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM notes WHERE chatID = :idC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function addNote($chatID, $contenuN) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO notes (chatID, contenuN, dateCreationN) 
                          VALUES (:chatID, :contenuN, NOW())");
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->bindValue(':contenuN', $contenuN, PDO::PARAM_STR);
    $req->execute();
    return $cnx->lastInsertId();
}

function delNote($idN) {
    $cnx = connexionPDO();
    $cnx->prepare("DELETE FROM photos WHERE noteID = :idN")->execute([':idN' => $idN]);
    $req = $cnx->prepare("DELETE FROM notes WHERE idN = :idN");
    $req->bindValue(':idN', $idN, PDO::PARAM_INT);
    return $req->execute();
}
?>