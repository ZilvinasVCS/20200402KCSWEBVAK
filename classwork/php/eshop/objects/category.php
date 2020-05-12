<?php

class Category {
    
    private $connection;
    private $tableName = "categories";
    
    public $id;
    public $name;
    
    public function __construct($db)
    {
        $this->connection = $db;
    }
    
    public function readAll()
    {
        $query = "SELECT id, name FROM " . $this->tableName . " ORDER BY name";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function readName()
    {
        $query = "SELECT name FROM " . $this->tableName . " WHERE id=:id limit 0,1";
        $stmt = $this->connection->prepare( $query );
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        empty($row['name']) ? $this->name = 'undefined' : $this->name = $row['name'];
        
        // instead of return we want to reuse $this-> everywhere
    }
}
