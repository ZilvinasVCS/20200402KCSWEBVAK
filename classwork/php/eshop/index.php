<?php

include_once 'config/env.php';

include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

include_once 'objects/product.php';
$product = new Product($db);
$stmt = $product->readAll($fromNumCalc, $itemsPerPage);
$numbersOfRowsInDatabase = $stmt->rowCount();

include_once 'objects/category.php';
$category = new Category($db);


$pageTitle = "Our producs";
include_once "layout_header.php";
?>

<div class="flex-container">
    <span class="right-button">
        <a href="create_product.php" class="btn btn-primary">Create product</a>
        </span>
    <span>
        <form action="<?php echo "search.php" ?>" method="get">
            <input name="q">
            <input type="submit" value="Search">
        </form>
    </span>
</div>

<?php
    if ($numbersOfRowsInDatabase > 0) {
?>
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Category</th>
    </tr>
    <?php
         while ($rowProduct = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($rowProduct);
            echo "<tr>";
                echo "<td>{$name}</td>";
                echo "<td>{$price}</td>";
                echo "<td>{$description}</td>";
                echo "<td>";
                    $category->id = $category_id; // expected value int
                    $category->readName();
                    echo $category->name;
                echo "</td>";
             
                echo "<td>
                        <a href='read_item.php?id={$id}' class='btn btn-primary'>Read item</a>
                        <a href='update_item.php?id={$id}' class='btn btn-info'>Edit item</a>
                        <a data-item-id='{$id}' class='btn btn-danger delete-item'>Delete item</a>
                    </td>";

            echo "</tr>";
        } ?>
</table>
<?php
    
    $pageUrl = "index.php?";
    $totalItems = $product->countAll();
        
    include_once 'pagination.php';

    } else {
        echo "<div class='alert alert-info'>No products in database.</div>";
    }
include_once "layout_footer.php";
