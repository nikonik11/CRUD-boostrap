<?php
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');

if($_POST){
    if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content'])){

        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);

        $req = $bdd->prepare("INSERT INTO post (title, content) VALUES (:title, :content)");
        $req->bindValue(':title', $title, PDO::PARAM_STR);
        $req->bindValue(':content', $content, PDO::PARAM_STR);
        $req->execute();

        $_SESSION['message'] = "Votre article a bien était ajouté";
        header('location: index.php');

    }
    else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
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
                <h1>Ajouter un produit</h1>
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
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="content">Content : </label>
                        <input type="text" id="content" name="content" class="form-control">
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>