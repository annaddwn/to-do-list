<?php
    
    include "./db.php";

    if(isset($_POST["hidden"])){
      $pertemuan = $_POST["editpertemuan"];
      $link = $_POST["editlink"];
      $id = $_POST["hidden"];
      $user_id = $_POST["user_id"];
      $category_id = $_POST["category_id"];
      $sql="UPDATE `record` SET `rno`='$id' , `pertemuan`='$pertemuan' , `link`='$link', `category_id`='$category_id' WHERE `rno`='$id' AND `user_id`='$user_id'";
      $result=mysqli_query($conn,$sql);


  }

    
    echo '


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Your Records</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form class="form" method="POST">
            <input type="hidden" name="hidden" id="hidden">
          <div class="mb-3">
              <label for="pertemuan" class="form-label">Pertemuan</label>
              <input type="text" class="form-control" id="editpertemuan" placeholder="Pertemuan disini..." name="editpertemuan">
          </div>


          <input type="hidden" name="user_id" value="8">


          <div class="mb-3">
              <label for="link" class="form-label">Link</label>
              <textarea class="form-control" id="editlink" rows="3" placeholder="Link disini..." name="editlink"></textarea>
          </div>



          <div class="mb-3">
                        <select name="category_id" class="form-select" aria-label="Default select example">
                            <option selected>Pilih Matkul</option> ';
                            $sqledit = "SELECT * FROM `category`"; 
                            $resultedit = mysqli_query($conn, $sqledit);
                            $num = mysqli_num_rows($resultedit);
                            while($fetch = mysqli_fetch_assoc($resultedit)){
                              echo "<option value='".$fetch['category_id']."'>".$fetch['category']."</option>";
                            }
                        echo '</select>
                    </div>

          

          <button type="submit" class="btn btn-primary" name="submit">Update Record</button>
      </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>';

?>