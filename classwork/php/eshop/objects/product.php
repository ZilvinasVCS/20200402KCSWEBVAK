<?php

class Product {
    private $connection;
    // TODO: move to env.php
    private $tableName = "products";
    
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $timestamp;
    
    public function __construct($db)
    {
        $this->connection = $db;
    }
    
    public function create()
    {
        $query = "INSERT INTO " . $this->tableName . "
                    SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created";
        $stmt = $this->connection->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
        $this->timestamp = date('Y-m-d H:i:s');

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->timestamp);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function readAll($fromNum, $tillNum)
    {
        $query = "SELECT
                    id, name, description, price, category_id
                FROM
                    " . $this->tableName . "
                    ORDER BY
                        created DESC
                    LIMIT
                        {$fromNum},{$tillNum}";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function countAll()
    {
        $query = "SELECT id FROM " . $this->tableName;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $res = $stmt->rowCount();
        
        return $res;
        
    }
    
    public function readItem()
    {
        // $query SELECT su WHERE salyga. tikrinsim pagal id
        $query = "SELECT
                    name, description, price, category_id
                FROM
                    {$this->tableName}
                WHERE
                    id = ?
                LIMIT
                    0,1";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->category_id = $row['category_id'];
    } 
    
    public function updateItem()
    {
        $query = "UPDATE
                    {$this->tableName}
                SET
                    name = :name,
                    description = :description,
                    price = :price,
                    category_id = :category_id
                WHERE
                    id = :id";
        $stmt = $this->connection->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));
                
        // bind bindParam(select element from SQL query, );
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function deleteItem()
    {
        $query = "DELETE FROM {$this->tableName} WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function search($searchWord = 'pho')
    {
        $query = "SELECT
                    cat.name as category_name, prod.id, prod.name, prod.description, prod.price, prod.category_id, prod.created
                FROM
                   {$this->tableName} prod
                   LEFT JOIN
                        categories cat
                    ON
                        prod.category_id = cat.id
                    WHERE
                        prod.name LIKE ? OR prod.description LIKE ?
                    ORDER BY
                        prod.name ASC
                    LIMIT
                        0, 20";
        $preparedSearchWordForSqlQuery = "%{$searchWord}%";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $preparedSearchWordForSqlQuery);
        $stmt->bindParam(2, $preparedSearchWordForSqlQuery);

        $stmt->execute();

        return $stmt;
    }
}
