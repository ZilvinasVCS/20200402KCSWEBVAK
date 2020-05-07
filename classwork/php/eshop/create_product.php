<?php
    // name our page
    $pageTitle = "Create new product";
    include_once "layout_header.php";

   echo "<div class='right-button-margin'>
            <a href='index.php' class='btn btn-default pull-right'>All products list</a>
        </div>";
?>
    <!-- post code here -->
    <?php
        if ($_POST) {
            // set product properties values from form values.
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
        <div><input type="text" name="name" placeholder="Product name"></div>
        <div><input type="text" name="description" placeholder="Description"></div>
        <div><input type="text" name="price" placeholder="Price"></div>
        <div>
            <?php
                // read categories from database
                echo "<select class='form-control' name='category_id'>";
                    echo "<option>Choose category</option>";
                    /* while ($rowCategory = ) {

                    } */
            ?>
        </div>
        <div><button type="submit">Create</button></div>
    </form>
<?php
    include_once "layout_footer.php";
?>
