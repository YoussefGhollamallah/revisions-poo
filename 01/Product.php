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
}

?>