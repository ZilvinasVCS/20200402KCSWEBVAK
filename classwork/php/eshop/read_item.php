<?php

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: product ID is needed');

// itraukti klases: dombaze, produktu, kateogrijos klase
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

include_once 'objects/product.php';
$product = new Product($db);
$product->id = $id;
$product->readItem();

include_once 'objects/category.php';
$category = new Category($db);
$stmt = $category->readAll();

$pageTitle = "Read item";
include_once "layout_header.php";

echo "<div class='right-button-margin'>
            <a href='index.php' class='btn btn-default pull-right'>All products list</a>
        </div>";
?>
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Name</td>
        <td><?php echo $product->name; ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo $product->description; ?></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><?php echo $product->price; ?></td>
    </tr>
    <tr>
        <td>Category</td>
        <td>
            <?php
                if ($product->category_id == 0) {
                    echo 'Undefined';
                    exit();
                } else {
                    while ($rowCategory = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($rowCategory);

                        if ($product->category_id == $id) {
                            echo $name;
                            break;
                        }
                    }
                }
            ?>
        </td>
    </tr>
</table>

<?php
include_once "layout_footer.php";
