<?php
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');


if(isset($_GET['idPost']) && !empty($_GET['idPost'])){

    $idPost = htmlspecialchars($_GET['idPost']);

    $req = $bdd->prepare('SELECT * FROM post WHERE idPost = :idPost');
    $req->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $req->execute();
    $result = $req->fetch();

    if(!$result){
        $_SESSION['erreur'] = "Cet ID n'existe pas";
        header('location: index.php');
    }

    $req = $bdd->prepare('DELETE FROM post WHERE idPost = :idPost');
    $req->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $req->execute();

    $_SESSION['message'] = "Votre article a bien était supprimé";
    header('location: index.php');

}
else {
    $_SESSION['erreur'] = "L'URL demandé n'existe pas";
    header('location: index.php');
}

?>
