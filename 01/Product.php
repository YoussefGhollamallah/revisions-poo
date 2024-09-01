<?php 

class Product {
    private int $id;
    private string $name;
    private array $photos;
    private int $price;
    private string $description;
    private int $quantity;
    private int $category_id;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $id, string $name, array $photos, int $price, string $description, int $quantity, int $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->category_id = $category_id;
        $this->createdAt = new DateTime(); 
        $this->updatedAt = new DateTime(); 
    }


    // Getters (accesseurs)
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPhotos(): array {
        return $this->photos;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getCategoryId(): int {
        return $this->category_id;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    // Setters (mutateurs)
    public function setName(string $name): void {
        $this->name = $name;
        $this->updateTimestamp();
    }

    public function setPhotos(array $photos): void {
        $this->photos = $photos;
        $this->updateTimestamp();
    }

    public function setPrice(int $price): void {
        $this->price = $price;
        $this->updateTimestamp();
    }

    public function setDescription(string $description): void {
        $this->description = $description;
        $this->updateTimestamp();
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
        $this->updateTimestamp();
    }

    public function setCategoryId(int $category_id): void {
        $this->category_id = $category_id;
        $this->updateTimestamp();
    }

    // Méthode pour mettre à jour le timestamp de updatedAt
    private function updateTimestamp(): void {
        $this->updatedAt = new DateTime(); // Mise à jour de updatedAt à la date et l'heure actuelles
    }

        // Méthode pour insérer le produit dans la base de données
        public function save(PDO $pdo): void {
            $stmt = $pdo->prepare("INSERT INTO product (name, photos, price, description, quantity, category_id, created_at, updated_at) 
                                   VALUES (:name, :photos, :price, :description, :quantity, :category_id, :created_at, :updated_at)");
            $stmt->execute([
                ':name' => $this->name,
                ':photos' => json_encode($this->photos), // Convertit le tableau de photos en JSON
                ':price' => $this->price,
                ':description' => $this->description,
                ':quantity' => $this->quantity,
                ':category_id' => $this->category_id,
                ':created_at' => $this->createdAt->format('Y-m-d H:i:s'),
                ':updated_at' => $this->updatedAt->format('Y-m-d H:i:s')
            ]);
            $this->id = $pdo->lastInsertId(); // Met à jour l'ID avec celui généré par la BDD
        }
}

?>