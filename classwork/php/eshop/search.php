<?php

$searchPhrase = isset($_GET['q']) ? $_GET['q'] : die('ERROR: You can\'t come here directly');


include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

include_once 'objects/product.php';
$product = new Product($db);

include_once 'objects/category.php';
$category = new Category($db);

$pageTitle = "Search page";
include_once "layout_header.php";

$stmt = $product->search($searchPhrase);

echo "<a href='index.php' class='btn btn-default'>Back to main page</a>";

echo "<ol>";
while ($rowProduct = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($rowProduct);
    echo "<li>{$name}</li>";
}
echo "</ol>";


include_once "layout_footer.php";
