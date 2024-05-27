<?php

session_start();

if( isset($_SESSION["login"]) ) {
    header("Location: navigasi.php");
    exit;
}

require 'dbregist.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");


    //cek username
    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session
            $_SESSION["login"] = true;
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: navigasi.php");
            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
    <title>Login Page</title>
</head>

<body>

    <div class="container">
        <div class="login-left">
            <div class="login-header">
                <h1>PROJECT BASDAT</h1>
                <p>Please log-in to use the platform</p>
            </div>



            <form class="login-form" action="" method="POST">
                <div class="login-form-content">
                    <div class="form-item">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username">
                    </div>
                    <div class="form-item">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="signin-form">
                        <button class="button-solid" type="submit" name="login" style="color: #fff">Log-in</button>
                    </div>
                    <div class="bottom-text">
                        Don't have account? <a href="registrasi.php">Signup here</a>
                    </div>
                    <?php if (isset($error)) : ?>
                        <p style="color: red; font-style: italic;">Username / Password Salah</p>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="login-right">
            <img src="image/s1.jpg" alt="image" width="400" height="500">
        </div>
    </div>






</body>

</html>
