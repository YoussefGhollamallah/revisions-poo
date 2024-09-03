<?php

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

    // Vérification que l'ID du produit est passé dans l'URL
    if (isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])) {
        $productId = $_POST['id'];

        // Requête pour récupérer le produit avec l'ID donné
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute([':id' => $productId]);

        // Récupération du produit sous forme de tableau associatif
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            // Hydratation de l'instance de la classe Product
            $product = new Product(
                $productData['id'],
                $productData['name'],
                json_decode($productData['photos'], true),
                $productData['price'],
                $productData['description'],
                $productData['quantity'],
                $productData['category_id'],
                new DateTime($productData['created_at']),
                new DateTime($productData['updated_at'])
            );

            // Affichage des informations du produit en utilisant Bootstrap
            echo '<div class="container mt-5">';
            echo '<div class="card mx-auto" style="max-width: 700px;">';

            // Affichage des photos du produit avec une taille adaptée
            if (!empty($product->getPhotos())) {
                echo '<img src="' . htmlspecialchars($product->getPhotos()[0]) . '" class="card-img-top" alt="' . htmlspecialchars($product->getName()) . '" style="max-height: 300px; object-fit: cover;">';
            }

            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($product->getName()) . '</h5>';
            echo '<p class="card-text"><strong>Prix : </strong>' . htmlspecialchars($product->getPrice()) . '€</p>';
            echo '<p class="card-text"><strong>Description : </strong>' . htmlspecialchars($product->getDescription()) . '</p>';
            echo '<p class="card-text"><strong>Quantité : </strong>' . htmlspecialchars($product->getQuantity()) . '</p>';

            // Affichage de la catégorie
            $stmtCategory = $pdo->prepare("SELECT name FROM category WHERE id = :id");
            $stmtCategory->execute([':id' => $product->getCategoryId()]);
            $category = $stmtCategory->fetch(PDO::FETCH_ASSOC);
            if ($category) {
                echo '<p class="card-text"><strong>Catégorie : </strong>' . htmlspecialchars($category['name']) . '</p>';
            }

            echo '</div>'; // Fin de la card-body
            echo '</div>'; // Fin de la card
            echo '</div>'; // Fin du container

        } else {
            echo '<div class="alert alert-danger">Produit avec l\'ID ' . htmlspecialchars($productId) . ' non trouvé.</div>';
        }

    } elseif (isset($_POST['id'])) {
        // Si un ID a été fourni mais qu'il est invalide (non numérique ou vide)
        echo '<div class="alert alert-danger">ID du produit invalide.</div>';
    }

} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erreur : ' . $e->getMessage() . '</div>';
}
?>

<div>
    <h1>Sélectionner un produit</h1>
    <form method="post" action="index.php?page=produit">
        <label for="product_id">ID du produit :</label>
        <input type="number" id="product_id" name="id" required>
        <button type="submit">Voir le produit</button>
    </form>
</div>
