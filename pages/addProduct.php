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

<div class="container d-flex justify-content-center flex-column align-items-center">
    <h1 class="mb-4">Ajouter un produit</h1>
    <form method="post" action="" class="w-50">
        <div class="mb-3">
            <label for="name" class="form-label">Nom du produit :</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="photos" class="form-label">URL de la photo :</label>
            <input type="text" id="photos" name="photos" class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Prix :</label>
            <input type="number" id="price" name="price" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantité :</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie :</label>
            <select id="category_id" name="category_id" class="form-select" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter le produit</button>
    </form>
</div>
