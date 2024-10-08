<?php 

require_once "01/Product.php";

class Category {

    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    // Setters
    public function setName(string $name): void {
        $this->name = $name;
        $this->updateTimestamp();
    }

    public function setDescription(string $description): void {
        $this->description = $description;
        $this->updateTimestamp();
    }

    // Méthode pour mettre à jour le timestamp de updatedAt
    private function updateTimestamp(): void {
        $this->updatedAt = new DateTime();
    }

    // Méthode pour insérer la catégorie dans la base de données
    public function save(PDO $pdo): void {
        $stmt = $pdo->prepare("INSERT INTO category (name, description, created_at, updated_at) VALUES (:name, :description, :created_at, :updated_at)");
        $stmt->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            ':updated_at' => $this->updatedAt->format('Y-m-d H:i:s')
        ]);
        $this->id = $pdo->lastInsertId(); // Met à jour l'ID avec celui généré par la BDD
    }


    public function getProducts(PDO $pdo): array {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE category_id = :category_id");
        $stmt->bindParam(':category_id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($resultat as $row) {
            $product = new Product(
                $row['id'],
                $row['name'],
                json_decode($row['photos'], true), // Décodage du JSON pour obtenir le tableau de photos
                $row['price'],
                $row['description'],
                $row['quantity'],
                $row['category_id']
            );
            $products[] = $product;
        }

        return $products;
    }

}