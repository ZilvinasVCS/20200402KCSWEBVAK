<?php

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: product ID is needed');

// itraukti klases: dombaze, produktu, kateogrijos klase
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

include_once 'objects/product.php';
$product = new Product($db);

include_once 'objects/category.php';
$category = new Category($db);
//sukurti objektus: database, product, category

$pageTitle = "Read item ";
include_once "layout_header.php";
$product->id = $id;
$product->readItem();
?>
<form>
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input name="name" value="<?php echo $product->name; ?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input name="name" value="<?php echo $product->description; ?>"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input name="name" value="<?php echo $product->price; ?>"></td>
        </tr>
        <tr>
            <td>Category</td>
            <td><!-- dropdown select tag --></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary">Update</button></td>
        </tr>
    </table>
</form>

<?php
include_once "layout_footer.php";
