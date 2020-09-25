<?php
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');

// Ma requete SELECT

$req = 'SELECT * FROM post';
$req = $bdd->prepare($req);
$req->execute();
$result = $req->fetchAll(PDO::FETCH_ASSOC);


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
            <section class="col-12">
                <h1>Découvrez mes Tutos sur vos langages favoris</h1>
                <?php
                    if(!empty($_SESSION['erreur'])){
                ?>
                    <div class="alert alert-danger" role="alert"> <?= $_SESSION['erreur'] ?></div>
                    <?= $_SESSION['erreur'] = "" ?>
                <?php        
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                ?>
                    <div class="alert alert-success" role="alert"> <?= $_SESSION['message'] ?></div>
                    <?= $_SESSION['message'] = "" ?>
                <?php        
                    }
                ?>
                <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($result as $produit) { 
                        ?>
                            <tr>
                                <td> <?= $produit['idPost'] ?> </td>
                                <td> <?= $produit['title'] ?> </td>
                                <td> <?= $produit['content'] ?> </td>
                                <td>
                                    <a href="read.php?idPost=<?= $produit['idPost'] ?>" class="btn btn-info">Voir</a>
                                    <a href="update.php?idPost=<?= $produit['idPost'] ?>" class="btn btn-warning">Modifier</a>
                                    <a href="delete.php?idPost=<?= $produit['idPost'] ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php    
                            }
                        ?>
                    </tbody>
                </table>
                <a href="create.php" class="btn btn-primary">Ajouter un article</a>
            </section>
        </div>
    </main>
</body>
</html>