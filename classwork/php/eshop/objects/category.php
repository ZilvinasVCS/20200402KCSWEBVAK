<?php
    // create new class Category
    // database connection - create new private property $connection
    //create new private property $tableName
    // create __construct method
    // new method read()
    // in new method make SQL query SELECT
    // excecute SQL query.

class Category {

    private $connection;
    private $tableName = "categories";

    public $id;
    public $name;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {

        // create SELECT SQL query.
        // pasirinkite id ir name is lenteles categories rikiuokite pagal varda
        $query = "SELECT id, name FROM " . $this->tableName . " ORDER BY name";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readName()
    {
        // query
        $query = "SELECT name FROM " . $this->tableName . " WHERE id = ? limit 0,1";
        // prepare
        $stmt = $this->connection->prepare($query);
        $stmt = bindParam(1, $this->id);
        // execute
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }
}


/*
$category = new Category($db); // string(4) test
$category->read();

$this->id = 2;
$category->readName();
*/
