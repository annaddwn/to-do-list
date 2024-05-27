<?php

include "./db.php";

if (isset($_POST['hidden'])) {
    $category = $_POST['editcategory'];
    $id = $_POST['hidden'];
    $sql = "UPDATE `category` SET `category_id`='$id' , `category`='$category' WHERE `category_id`='$id'";
    $result = mysqli_query($conn, $sql);
}



echo '
    
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form" method="POST">
                    <input type="hidden" name="hidden" id="hidden">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="editcategory" placeholder="Category here..." name="editcategory">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Update Category</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
    
    ';

?>
