<?php

declare(strict_types = 1);

namespace Gdakuzak\Model;

class Product
{
    private $id;
    private $name;
    private $price;
    private $quantity;
    private $total;
    private $pdo;

    /**
     * Product constructor
     * @param $pdo
     */
    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return (int) $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name): Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): ?float
    {
        return (float) $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price): Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity(): ?int
    {
        return (int) $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity): Product
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal(): ?float
    {
        return (float) $this->total;
    }

    public function hydrate(array $data)
    {
        $this->id = $data['id'];
        $this->setName($data['name'])
            ->setPrice($data['price'])
            ->setQuantity($data['quantity']);
        $this->total = $data['total'];
    }

    public function save(array $data): Product
    {
        if(!isset($data['id'])) {
            $query = "INSERT INTO products (`name`,`price`,`quantity`,`total`) VALUES (:name,:price,:quantity,:total)";
            $stmt = $this->pdo->prepare($query);
        } else { 
            $query = "UPDATE products SET `name` = :name,`price` = :price,`quantity` = :quantity, `total` = :total where `id` = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":id",$data['id']);
        }
        $stmt->bindValue(":name",$data['name']);
        $stmt->bindValue(":price",$data['price']);
        $stmt->bindValue(":quantity",$data['quantity']);
        $data['total'] = $data['price']*$data['quantity'];
        $stmt->bindValue(":total",$data['total']);

        $stmt->execute();
        $data['id'] = $data['id'] ?? $this->pdo->lastInsertId();
        $this->hydrate($data);
        return $this;
    }

    public function delete(int $id): bool 
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        return $stmt->execute();
    }

    public function all()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(int $id): Product
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(!$data){
            throw new \Exception('Product does not exist');
        }
        $this->hydrate($data);
        return $this;
    }

}

