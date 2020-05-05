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
            <div class="main-wrapper-signup">
                <h2>Sign up</h2>
                <form class="signup-form" action="includes/signup.inc.php" method="POST">
                    <input name="first" placeholder="First name">
                    <input name="last" placeholder="Last name">
                    <input name="email" placeholder="Email">
                    <input name="uid" placeholder="Username">
                    <input name="pwd" placeholder="Password">
                    <button type="submit" name="submit">Sign up</button>
                </form>
            </div>
        </section>
        <?php include('footer.php'); ?>
    </body>
</html>
