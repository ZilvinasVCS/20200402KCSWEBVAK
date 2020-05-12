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

$pageTitle = "Read item ";
include_once "layout_header.php";


// validate form on SUBMIT / $_POST
if ($_POST) {
    // priskirkite objektui $product visus galimu property is formos POST reiksmiu.
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];
    $product->category_id = $_POST['category_id'];
    // call method updateItem()
    if ($product->updateItem()) {
        echo "<div class='alert alert-success'>Product is updated!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error. Unable to update product</div>";
    }
}

?>
<form action="<?php $_SERVER["PHP_SELF"] . "?id={$id}"; ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input name="name" value="<?php echo $product->name; ?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><input name="description" value="<?php echo $product->description; ?>"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input name="price" value="<?php echo $product->price; ?>"></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <?php
                    echo "<select class='form-control' name='category_id'>";
                        echo "<option>Choose category</option>";
                        while ($rowCategory = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($rowCategory);

                            if ($product->category_id == $id) {
                                echo "<option value='{$id}' selected>";
                            } else {
                                echo "<option value='{$id}'>";
                            }
                            echo "{$name}</option>";
                        }
                    echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary">Update</button></td>
        </tr>
    </table>
</form>

<?php
include_once "layout_footer.php";
