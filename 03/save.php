<?php

require_once __DIR__ . "/../02/Category.php";
require_once __DIR__ . "/../01/Product.php";
require_once __DIR__ . "/../config/dbconfig.php";

// Configuration de la base de données
$host = DB_HOST;
$dbname = DB_NAME;
$username = DB_USER;
$password = DB_PASSWORD;

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertion des catégories
    $category3 = new Category(0, 'fruits', 'Catégorie pour les produits liés aux fruits');
    $category3->save($pdo);

    $category4 = new Category(0, 'Legumes', 'Catégorie pour les produits légume');
    $category4->save($pdo);

    // Insertion des produits
    $product1 = new Product(0, 'Fraise', ['https://picsum.photos/200/300'], 1250, 'fraise d\'espagne', 3, $category3->getId());
    $product1->save($pdo);

    $product2 = new Product(0, 'Patate', ['https://picsum.photos/200/300'], 999, 'Patate du Maroc', 5, $category4->getId());
    $product2->save($pdo);

    echo "Catégories et produits insérés avec succès.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
