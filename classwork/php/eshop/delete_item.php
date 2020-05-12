<?php

if (!$_POST) {
    echo 'This page can\'t be reached directly';
    sleep(3);
    header("Location: index.php");
}

// itraukti klases: dombaze, produktu, kateogrijos klase
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

include_once 'objects/product.php';
$product = new Product($db);
$product->id = $_POST['delete_this_item'];

if ($product->id > 0) {

    if ($product->deleteItem()) {
        echo "<div class='alert alert-success'>Product, which id is \"$product->id\" is deleted!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error. Unable to delete product</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Error. Product must be positive integer.</div>";
}
