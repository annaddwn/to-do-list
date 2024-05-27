<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DEADLINE</title>
  <link rel="stylesheet" href="dead.css">
</head>

<body>
  <?php include "./db.php"; ?>

  <?php
  if (isset($_POST['submit'])) {

    if (!isset($_POST["hidden"])) {
      $deadline = $_POST['title'];
      $date = $_POST['date'];
      $user_id = $_POST['user_id'];
      $category_id = $_POST['category_id'];

      if ($category_id == "NULL") {
        /* ini cek jika ga ada kategori yang dimasukin, maka dia akan null */
        $sql = "INSERT INTO `deadline` (`user_id`, `deadline`, `date`) VALUES ('$user_id', '$deadline', '$date')";
      } else {
        /* insert to ini bisa diambil dari phpmyadmin, cek aja */
        $sql = "INSERT INTO `deadline` (`user_id`, `category_id`, `deadline`, `date`) VALUES ('$user_id', '$category_id', '$deadline', '$date')";
      }
      $result = mysqli_query($conn, $sql);
    }
  }

  ?>
  <div class="navbar">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content">
        <div class="logo"><a href="navigasi.php">PROJECT BASDAT</a></div>
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
    </nav>
  </div>

  <div class="wrapper">
    <div class="container bg-white shadow">
      <h2 class="container-header text-center">DEADLINE</h2>
      <form class="form" action="#" id="form">
        <div class="form-group form-title">
          <label for="title">Masukkan matkul/materi</label>
          <input type="text" id="title" name="title" required>
        </div>

        <!-- ini value isinya user id dari yang login, untuk masalah lebih lanjut langsung aja ke session di login -->
        <input type="hidden" name="user_id" value="8">

        <div class="form-group form-title">
          <label for="date">Masukkan deadline</label>
          <input type="date" id="date" name="date" required>
        </div>

        <!-- disini untuk category -->

        <input type="submit" value="Submit" name="Submit" class="btn-submit">
      </form>
    </div>

    <div class="container">
      <h2 class="container-header">Tugas yang belum dikerjakan</h2>
      <div class="list-item" id="todos">

      </div>
    </div>

    <div class="container">
      <h2 class="container-header">Tugas yang sudah dikerjakan</h2>
      <div class="list-item" id="completed-todos">

      </div>
    </div>
  </div>

  <script src="js/data.js" type="text/javascript"></script>
  <script src="js/dom.js" type="text/javascript"></script>
  <script src="js/script.js" type="text/javascript"></script>
</body>

</html>