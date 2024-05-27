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
    <link rel="stylesheet" href="style.css">
    <title>Form Catatan</title>
</head>

<body>
    <!-- ini bagian dari php yang mau diambil -->
    <?php include "./db.php"; ?>
    <?php include "./editModal.php"; ?>

    <!-- ini untuk ngehubungin database ke index.php ini -->
    <?php
    if (isset($_POST['submit'])) {
            /* jika tidak hidden yang dibawah ini maksudnya itu jika tidak edit, maka lakukan create */
            if(!isset($_POST["hidden"])){
            $title = $_POST['title'];
            $note = $_POST['note'];
            $user_id = $_SESSION['user_id'];
            $category_id = $_POST['category_id'];

            if($category_id == "NULL"){
                /* ini cek jika ga ada kategori yang dimasukin, maka dia akan null */
                $sql = "INSERT INTO `notes` (`user_id`, `title`, `note`) VALUES ('$user_id', '$title', '$note')";
            }else{
                /* insert to ini bisa diambil dari phpmyadmin, cek aja */
                $sql = "INSERT INTO `notes` (`user_id`, `category_id`, `title`, `note`) VALUES ('$user_id', '$category_id', '$title', '$note')";
            }

            $result = mysqli_query($conn, $sql);
        }
    }
    ?>

    <div class="container mt-5">
        <a href="category.php">
            <button type="button" class="btn btn-primary">Category</button>
        </a>
    </div>
    

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- asli ini jangan lupa method post nya -->
                <form class="form" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" placeholder="Judul Disini Ya..." name="title">
                    </div>

                    <!-- ini value isinya user id dari yang login, untuk masalah lebih lanjut langsung aja ke session di login -->
                    <!-- <input type="hidden" name="user_id" value="8"> -->

                    <div class="mb-3">
                        <label for="note" class="form-label">Notes</label>
                        <textarea class="form-control" id="note" rows="3" placeholder="Masukin Notesnya disini..." name="note"></textarea>
                    </div>
                    <div class="mb-3">
                        <select name="category_id" class="form-select" aria-label="Default select example">
                            <option value= "NULL" selected>Pilih Matkul</option>
                                <?php
                                    /* select all from category where user id adalah user yang login sekarang */
                                    $sql = "SELECT * FROM `category`"; 
                                    $result = mysqli_query($conn, $sql);
                                    $num = mysqli_num_rows($result);
                                    
                                    while($fetch = mysqli_fetch_assoc($result)){
                                        echo "<option value='".$fetch['category_id']."'>".$fetch['category']."</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Tambah Note</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1>Your Notes</h1>
                <!-- fetch bisa dibilang gunanya untuk mengambil data dari database -->
                <!-- yang .fetch[title] itu diambil dari title yang ada di phpmyadmin, dan yang .fetch[note] itu diambil dari note yang ada di phpmyadmin -->
                <?php
                /* select all from notes where user id adalah user yang login sekarang */
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                /* no notes ini kalau notes nya ga ada */
                $noNotes = true;
                while ($fetch = mysqli_fetch_assoc($result)) {
                    $noNotes = false;
                    $sqlresult = mysqli_query($conn, "SELECT * FROM `category` WHERE `category_id` = '".$fetch['category_id']."'");
                    echo '<div class="card my-3">
                                <div class="card-body">';
                                    if($fetch["category_id"]){
                                        echo '<h3 class="card-title">' . mysqli_fetch_assoc($sqlresult)['category'] . '</h3>';
                                    }
                                    echo '
                                    <h5 class="card-title">' . $fetch["title"] . '</h5>
                                    <p class="card-text">' . $fetch["note"] . '</p>
                                    <button type="button" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' . $fetch["sno"] . '" >Edit</button>
                                    <a href="./delete.php?id=' . $fetch["sno"] . '" class="btn btn-danger">Delete</a>
                                </div>
                                </div>
                            </div>';
                }

                if ($noNotes) {
                    echo '<div class="card my-3">
                                <div class="card-body">
                                    <h5 class="card-title">Message :</h5>
                                    <p class="card-text">Ga ada notes :( , tambah dulu ya diatas</p>
                                </div>
                                </div>
                            </div>';
                }
                ?>

            </div>
        </div>
    </div>

    <script>
        // ini untuk bagian modal dari edit dan nampilin data yang ada sebelumnya
        const edit = document.querySelectorAll('.edit');
        const editTitle = document.getElementById('edittitle');
        const editNote = document.getElementById('editnote');
        const hiddenInput = document.getElementById('hidden');
        edit.forEach(element => {
            element.addEventListener('click', () => {
                const titleText = element.parentElement.children[1].innerText;
                const noteText = element.parentElement.children[2].innerText;
                editTitle.value = titleText;
                editNote.value = noteText;
                hiddenInput.value = element.id;
                console.log(hiddenInput);
            })
        });
    </script>






            <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
