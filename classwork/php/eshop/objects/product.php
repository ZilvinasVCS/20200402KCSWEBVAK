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

    // create new method countAll() which returns rowCount() / fetchColumn() value
    public function countAll()
    {
        $query = "SELECT id FROM " . $this->tableName;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $res = $stmt->rowCount();

        return $res;

    }
    // include pagination.php file in index.php
    // call this method in pagination.php

}
