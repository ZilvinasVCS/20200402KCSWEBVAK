<?php
    /* var_dump($_POST); */
    $vardas = htmlspecialchars(trim($_POST['vardas']));
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($vardas) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $from = "$email";
            $to = 'zilvinasvcs@gmail.com';
            $subject = 'Nauja žinutė';
            $autorius = 'Nuo' . $vardas . ', ' . 'El paštas asmens: ' . $email;
            $zinute = htmlspecialchars($message);
            mail($to, $subject, $autorius, $zinute, $from);
            echo "<script>alert('Žinutė išsiųsta');</script>";
        }
    }

include('db.php');
