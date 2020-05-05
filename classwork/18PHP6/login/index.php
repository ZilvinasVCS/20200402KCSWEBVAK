<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP kursas - Login forma</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php include('header.php'); ?>
        <section class="main-container">
            <div class="main-wrapper">
                <h2>Home</h2>
                <?php
                    if (isset($_SESSION['u_id'])) {
                        echo "<p>Sekmingai prisijungta</p>";
                    }
                ?>
            </div>
        </section>
        <?php include('footer.php'); ?>
    </body>
</html>
