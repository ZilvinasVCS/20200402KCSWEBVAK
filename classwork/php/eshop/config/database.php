<?php
 // create new class. class name is Database. create new method getConnection().
 // create new private properties: $host, $dbName, $userName, $password
 // create new public property $connection
 // create connection to database with try and catch

class Database {

    // properties list
    private $host = "localhost";
    private $dbName = "eshop";
    private $userName = "root";
    private $password = "";
    public $connection;

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }
}
