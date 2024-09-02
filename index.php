<?php

require_once __DIR__ . "/01/Product.php";
require_once __DIR__ . "/02/Category.php";

$firstCategory = new Category(1, "Chien", "les chiens faut partie des canidées.");
$firstProduct = new Product(1, "Chien", ["https://picsum.photos/id/237/200/300"],1250, "Bébé Labrador", 3, 1, new DateTime(), new DateTime());



?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
        
        <?php  include_once __DIR__ . "/includes/_header.php"; ?>
        
        <!-- Affichage des informations du produit -->
        <!-- <h1><?php echo $firstProduct->getName(); ?></h1> -->
        <!-- Affichage de la première photo -->
        <!-- <img src="<?php echo $firstProduct->getPhotos()[0]; ?>" alt="<?php echo $firstProduct->getName(); ?>"> -->
        <!-- <p><?php echo $firstProduct->getDescription(); ?></p> -->
        <!-- <p>Prix : <?php echo $firstProduct->getPrice(); ?> €</p> -->
        <!-- <p>Quantité disponible : <?php echo $firstProduct->getQuantity(); ?></p> -->        
        <main>

            <?php
            // Définit la page par défaut
            $page = isset($_GET['page']) ? $_GET['page'] : 'index';
            
            // Chemin du fichier correspondant à la page
            $file = __DIR__ . "/pages/" . $page . ".php";
            
            // Vérifie si le fichier existe, sinon, affiche une erreur
            if (file_exists($file)) {
                require_once($file);
            } else {
                require_once (__DIR__. "/pages/page404.php");
            }
            ?>
        </main>
        <?php 
            // require_once "pages/addProduct.php";
            // var_dump($firstProduct);
            // echo $firstProduct->getName();
            // $firstProduct->setName("Labrador");
            // echo "<br>";
            // echo $firstProduct->getName();
            
        ?>
    </body>
</html>