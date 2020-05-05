<?php
    session_start();
    if (isset($_POST['submit'])) {
        include_once 'db.inc.php';
        $uid = mysqli_real_escape_string($mysqli, $_POST['uid']);
        $pwd = mysqli_real_escape_string($mysqli, $_POST['pwd']);

        // patikrinti ar uid ir pwd nera tusti. jeigu tusti tai header(login=empty)
        if (empty($uid) || empty($pwd)) {
            header("Location: ../index.php?login=empty");
            exit();
        } else {
            // patikrinti ar toks uid egzistuoja duomenu bazeje. jeigu nera tai header(login=error)
            $query = "SELECT * FROM users WHERE user_uid = '$uid';";
            $result = mysqli_query($mysqli, $query);
            $resulCheck = mysqli_num_rows($result);

            if ($resulCheck < 1) {
                header("Location: ../index.php?login=error");
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    $hashPwd = password_verify($pwd, $row['user_pwd']);
                    if ($hashPwd == false) {
                        header("Location: ../index.php?login=error");
                        exit();
                    } elseif ($hashPwd == true) {
                        // priskirkime sesijai duomenis is dombazes
                        $_SESSION['u_id'] = $row['user_id'];
                        $_SESSION['u_first'] = $row['user_first'];
                        $_SESSION['u_last'] = $row['user_last'];
                        $_SESSION['u_email'] = $row['user_email'];
                        $_SESSION['u_uid'] = $row['user_uid'];
                        header("Location: ../index.php?login=success");
                        exit();
                    }
                }
            }
        }

    } else {
        header("Location: ../index.php?login=error");
        exit();
    }
