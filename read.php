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

}
else {
    $_SESSION['erreur'] = "L'URL demandé n'existe pas";
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails de l'article : <?=$result['title'] ?></h1>
                <p>Contenu de l'article : <?=$result['content'] ?></p>
                <p>
                    <a href="update.php?idPost=<?= $result['idPost'] ?>" class="btn btn-warning">Modifier</a>
                    <a href="delete.php?idPost=<?= $result['idPost'] ?>" class="btn btn-danger">Supprimer</a>
                    <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a> 
                </p>
            </section>
        </div>
    </main>
</body>
</html>