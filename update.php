<?php
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');


if($_POST){
    if(isset($_POST['idPost']) && !empty($_POST['idPost']) && isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content'])){

        $idPost  = htmlspecialchars($_POST['idPost']);
        $title   = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);

        $req = $bdd->prepare("UPDATE post SET idPost = :idPost, title = :title, content = :content WHERE idPost = :idPost");
        $req->bindValue(':idPost', $idPost, PDO::PARAM_INT);
        $req->bindValue(':title', $title, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->execute();

        $_SESSION['message'] = "Votre article a bien était modifié";
        header('location: index.php');

    }
    else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-8">
                <h1>Modifier un produit</h1>
                <?php
                    if(!empty($_SESSION['erreur'])){
                ?>
                    <div class="alert alert-danger" role="alert"> <?= $_SESSION['erreur'] ?></div>
                    <?= $_SESSION['erreur'] = "" ?>
                <?php        
                    }
                ?>
                <form method="post">
                    <div class="form-group">
                        <label for="title">Title : </label>
                        <input type="text" id="title" name="title" class="form-control" value=" <?= $result['title'] ?>">
                    </div>
                    <div class="form-group">
                    <label for="content">Content : </label>
                        <input type="text" id="content" name="content" class="form-control" value=" <?= $result['content'] ?>">
                    </div>
                    <input type="hidden" value=" <?= $result['idPost'] ?>" name="idPost">
                    <button class="btn btn-warning">Modifier</button>
                    <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>