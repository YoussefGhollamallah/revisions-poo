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
        <title>Document</title>
    </head>
    <body>
        
        <!-- Affichage des informations du produit -->
        <!-- <h1><?php echo $firstProduct->getName(); ?></h1> -->
        <!-- Affichage de la première photo -->
        <!-- <img src="<?php echo $firstProduct->getPhotos()[0]; ?>" alt="<?php echo $firstProduct->getName(); ?>"> -->
        <!-- <p><?php echo $firstProduct->getDescription(); ?></p> -->
        <!-- <p>Prix : <?php echo $firstProduct->getPrice(); ?> €</p> -->
        <!-- <p>Quantité disponible : <?php echo $firstProduct->getQuantity(); ?></p> -->        
        
        <?php 
            var_dump($firstProduct);
            echo $firstProduct->getName();
            $firstProduct->setName("Labrador");
            echo "<br>";
            echo $firstProduct->getName();
            
        ?>
    </body>
</html>