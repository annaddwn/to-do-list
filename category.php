<?php
session_start();

  if( !isset($_SESSION["login"]) ) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Category</title>
</head>

<body>

    <?php include "./db.php"; ?>
    <?php include "./editcategory.php"; ?>

    <?php

        if (isset($_POST['submit'])) {
            if(!isset($_POST["hidden"])){
            $category = $_POST['category'];
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO `category` (`user_id`, `category`) VALUES ('$user_id', '$category')";
            $result = mysqli_query($conn, $sql);
            }
        }

    ?>

    <div class="container mt-5">
        <div class="row">
            <h1 class="h1 mb-4">Add Category</h1>

            <form action="category.php" method="POST">
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="category" placeholder="Tambah Disini Ya..." name="category">
                </div>


                <!-- ini value isinya user id dari yang login, untuk masalah lebih lanjut langsung aja ke session di login -->
                <input type="hidden" name="user_id" value="8">


                <button type="submit" class="btn btn-primary" name="submit">Tambah Kategori</button>


            </form>

            <h3 class="mt-4">List Category</h3>

            <?php

                $sql = "SELECT * FROM `category`";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                
                while($fetch = mysqli_fetch_assoc($result)){
                    echo "<div class='card mt-3' style='width: 18rem;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$fetch['category']}</h5>
                        
                        <button type='button' class='btn btn-primary edit' data-bs-toggle='modal' data-bs-target='#exampleModal' id='".$fetch["category_id"]."'>
                        Edit
                        </button>

                        <a href='deleteCategory.php?id={$fetch['category_id']}' class='btn btn-danger'>Delete</a>


                    </div>
                    </div>";
                }

            ?>

            
        </div>
        <!-- kembali ke index.php -->
        <a href="index.php" class="btn btn-info mt-4">Kembali</a>
    </div>

    <script>

        const edit = document.querySelectorAll('.edit');
        const editCategory = document.getElementById('editcategory');
        const hiddenInput = document.getElementById('hidden');
        edit.forEach(element => {
            element.addEventListener('click', () => {
                const categoryText = element.parentElement.children[0].innerText;
                editCategory.value = categoryText; 
                hiddenInput.value = element.id;
                console.log(hiddenInput);
            })
        });

    </script>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
