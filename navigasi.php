<?php
session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }
?>

<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>MENU DASHBOARD</title>
  <link rel="stylesheet" href="navigasi.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
      <div class="logo"><a href="navigasi.html">PROJECT BASDAT</a></div>
        <ul class="links">
          <li><a href="navigasi.php">Home</a></li>
          <li><a href="dead.php">Deadline</a></li>
          <li><a href="index.php">Notes</a></li>
          <li><a href="record.php">Record Zoom</a></li>
          
      </div>
      <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
      <form action="#" class="search-box">
        <input type="text" placeholder="Type Something to Search..." required>
        <button type="submit" class="go-icon"><i class="fas fa-long-arrow-alt-right"></i></button>
      </form>
      <div class="logo_logout">
        <a href="logout.php" style="text-decoration: none; color: white; font-size: medium;">LOGOUT</a>
      </div>
    </nav>
  </div>
  
  <section class="services" id="services">

    <h1 class="heading"</h1>

    <div class="box-container">

        <div class="box">
            <img src="image/s-3.svg" alt="">
            <h3>Deadline</h3>
            <p>Cek deadline tugas</p>
            <a href="dead.php" class="btn">Deadline</a>
        </div>

        <div class="box">
            <img src="image/s-1.svg" alt="">
            <h3>Notes</h3>
            <p>Buat catatan dan cek catatan</p>
            <a href="index.php" class="btn">Catatan</a>
        </div>

        <div class="box">
            <img src="image/s-2.svg" alt="">
            <h3>Record Zoom</h3>
            <p>Cek record zoom yang diupload PJ</p>
            <a href="record.php" class="btn">Record Zoom</a>
        </div>


    </div>
  </section>



</body>
</html>
