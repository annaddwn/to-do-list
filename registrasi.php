<?php

require 'dbregist.php';

    if(isset($_POST["register"])){

        if( registrasi($_POST) > 0 ){
            echo "<script>
                    alert('User baru berhasil ditambahkan!');
                </script>";
            
            header("Location: login.php");
        } else {
            echo mysqli_error($conn);
        }

    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
    <title>Signup Page</title>

    <style>
        label {
            display: block;
        }
        ul{
            list-style: none;
        }
    </style>

</head>


<body>
    
    <div class="container">
        <div class="login-left">
            <div class="login-header">
                <h1>PROJECT BASDAT</h1>
                <p>Please sign-in to use the platform</p>
            </div>

            <form class="login-form" action="" method="POST">
                <div class="login-form-content">
                    <div class="form-item">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username">
                    </div>

                    <div class="form-item">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password">
                    </div>

                    <div class="form-item">
                        <label for="password2">Konfirmasi Password:</label>
                        <input type="password" name="password2" id="password2">
                    </div>

                    <div class="signin-form">
                        <button class="button-solid" type="submit" name="register" style="color: #fff">Sign-In</button>
                    </div>
                </div>
                <div class="bottom-text">
                    Already have account? <a href="login.php">Login here</a>
                </div>
            </form>
        </div>
        <div class="login-right">
            <img src="image/s1.jpg" alt="image" width="400" height="500">
        </div>
    </div>

</body>
</html>
