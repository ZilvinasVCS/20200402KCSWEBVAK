<?php

    include_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();

    $pageTitle = "Create new product";
    include_once "layout_header.php";

   echo "<div class='right-button-margin'>
            <a href='index.php' class='btn btn-default pull-right'>All products list</a>
        </div>";
?>
<?php
    if ($_POST) {

        include_once 'objects/product.php';
        $product = new Product($db);

        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->category_id = $_POST['category_id'];

        if ($product->create()) {
            echo "<div class='alert alert-success'>Product is created!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error. Unable to create product</div>";
        }
    }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Category</td>
            <td>
            <?php
                include_once 'objects/category.php';
                $category = new Category($db);
                $stmt = $category->read();

                echo "<select class='form-control' name='category_id'>";
                    echo "<option>Choose category</option>";
                    while ($rowCategory = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($rowCategory);
                        echo "<option value='{$id}'>{$name}</option>";
                    }
                echo "</select>";
            ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
    </table>
</form>
<?php
    include_once "layout_footer.php";
?>
