<?php

include_once __DIR__ . "/../config/dbconfig.php";
include_once __DIR__ . "/../01/Product.php";

// Configuration de la base de données
$host = DB_HOST;
$dbname = DB_NAME;
$username = DB_USER;
$password = DB_PASSWORD;

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des catégories existantes
    $stmt = $pdo->prepare("SELECT id, name FROM category");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérification si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $photos = isset($_POST['photos']) ? [$_POST['photos']] : [];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];

        // Création de l'objet Product
        $product = new Product(0, $name, $photos, $price, $description, $quantity, $category_id);

        // Sauvegarde du produit dans la base de données
        $product->save($pdo);

        echo "Produit ajouté avec succès.";
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
</head>
<body>
    <h1>Ajouter un produit</h1>
    <form method="post" action="addProduct.php">
        <label for="name">Nom du produit :</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="photos">URL de la photo :</label>
        <input type="text" id="photos" name="photos"><br><br>

        <label for="price">Prix :</label>
        <input type="number" id="price" name="price" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="quantity">Quantité :</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="category_id">Catégorie :</label>
        <select id="category_id" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Ajouter le produit</button>
    </form>
</body>
</html>
