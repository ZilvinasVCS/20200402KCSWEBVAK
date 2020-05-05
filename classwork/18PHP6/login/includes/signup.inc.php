<?php
    // Patikrinime, kad vartotojas pasiekė šį failą netiesiogiai
    if (isset($_POST['submit'])) {
        include_once 'db.inc.php';
        $first = mysqli_real_escape_string($mysqli, $_POST['first']);
        $last = mysqli_real_escape_string($mysqli, $_POST['last']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $uid = mysqli_real_escape_string($mysqli, $_POST['uid']);
        $pwd = mysqli_real_escape_string($mysqli, $_POST['pwd']);

        // patikrinti ar nera post duomenys tusti
        //var_dump($_POST);
        //die('asd');
        if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
            // jeigu tuscia tai pakeisti header i tuscia
            header("Location: ../signup.php?signup=empty");
            exit();
        } else {
            // patikrinti ar vardas ir pavarde yra is raidziu
            if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../signup.php?signup=invalidnameorlastname");
                exit();
            } else {
                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                     header("Location: ../signup.php?signup=invalidemail");
                     exit();
                 } else {
                     // pasitikriname ar toks vartotojas neegzistuoja duomenu bazeje
                     $query = "SELECT * FROM users WHERE user_uid = '$uid';";
                     $result = mysqli_query($mysqli, $query);
                     $resulCheck = mysqli_num_rows($result);

                     if ($resulCheck > 0) {
                         header("Location: ../signup.php?signup=usernameistaken");
                     } else {
                         // sukuriame apsaugota slaptazodi
                         $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                         $query = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES('$first', '$last', '$email', '$uid', '$hashedPwd');";
                         mysqli_query($mysqli, $query);
                         header("Location: ../signup.php?signup=success");
                         exit();
                     }
                 }
            }
        }

    } else {
        header("Location: ../signup.php");
        exit();
    }
