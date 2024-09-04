<?php


$dsn = 'mysql:host=localhost;dbname=draft_shop;charset=utf8';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
// Inclusion des classes nécessaires
require_once __DIR__ . '/../02/Category.php';
require_once __DIR__ . '/../01/Product.php';


// Initialisation des variables
$categoryId = null;
$products = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = intval($_POST['category_id']);

    // Récupérer la catégorie depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM category WHERE id = :id");
    $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($categoryData) {
        $category = new Category($categoryData['id'], $categoryData['name'], $categoryData['description']);
        $products = $category->getProducts($pdo);
    } else {
        echo "<p>Catégorie non trouvée.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupérer les Produits par Catégorie</title>
</head>
<body>
    <h1>Récupérer les Produits par Catégorie</h1>

    <form method="POST" action="">
        <label for="category_id">ID de la Catégorie :</label>
        <input type="number" id="category_id" name="category_id" required>
        <button type="submit">Récupérer les Produits</button>
    </form>

    <?php if ($categoryId && !empty($products)): ?>
        <h2>Produits pour la Catégorie ID: <?= htmlspecialchars($categoryId) ?></h2>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <strong><?= htmlspecialchars($product->getName()) ?></strong><br>
                    Prix: <?= htmlspecialchars($product->getPrice()) ?> EUR<br>
                    Description: <?= htmlspecialchars($product->getDescription()) ?><br>
                    Quantité: <?= htmlspecialchars($product->getQuantity()) ?><br>
                    Photos: <?= implode(', ', $product->getPhotos()) ?><br>
                    Créé le: <?= htmlspecialchars($product->getCreatedAt()->format('Y-m-d H:i:s')) ?><br>
                    Mis à jour le: <?= htmlspecialchars($product->getUpdatedAt()->format('Y-m-d H:i:s')) ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($categoryId && empty($products)): ?>
        <p>Aucun produit trouvé pour cette catégorie.</p>
    <?php endif; ?>
</body>
</html>
