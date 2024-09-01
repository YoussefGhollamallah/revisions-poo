<?php 

class Product {
    private int $id;
    private string $name;
    private string $photos;
    private int $price;
    private string $description;
    private int $quantity;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $id, string $name, string $photos, int $price, string $description, int $quantity)
    {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
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

    public function getPhotos(): string {
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

    public function setPhotos(string $photos): void {
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

    // Méthode pour mettre à jour le timestamp de updatedAt
    private function updateTimestamp(): void {
        $this->updatedAt = new DateTime(); // Mise à jour de updatedAt à la date et l'heure actuelles
    }

}

?>