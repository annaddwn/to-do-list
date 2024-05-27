<?php
    /* jangan lupa include databasenya db */
    include "./db.php";

    /* ini untuk delete nya */
    $id=$_GET["id"];
    $deleteQuery="DELETE FROM `notes` WHERE `sno`='$id'";
    $result=mysqli_query($conn,$deleteQuery);

    /* ini untuk balik lagi ke laman index.php waktu neken delete */
    header("location: ./index.php");
?>