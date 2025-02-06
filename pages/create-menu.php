<?php 
    include '../controller/session_check.php';

    $title = "Warongs's Admin ";
    include('../layout/header.php'); 
    include('../layout/sidenav-admin.php'); 
?>
<?php 
    include('../db/db_connection.php');
    $query = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <h2 class="mt-4">Add Menu</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Adding variation of foods to menu.</li>
            </ol>
            <div class="card mb-4">
                <form class="p-4"  method="POST" enctype="multipart/form-data" action="/order-system/controller/submit_menu.php"> 
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="Enter menu name">
                    </div>                        
                    <div class="mb-3">
                        <label for="menu-desc" class="form-label">Description</label>
                        <textarea class="form-control" id="menu-desc" name="menu_desc" placeholder="Write some item description..." ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input type="file" id="formFile" name="img"  class="form-control" accept="image/* ">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" required>
                    </div>

                    <div class="mb-3">
                        <label for="category-id"  class="form-label">Select Category</label>
                        <select class="form-select" id="category-id" name="category_id" required>
                            <option selected>Select a category</option>
                            <?php   
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<option value='" . $row['id'] ."'>". htmlspecialchars($row['name']) . "</option>";
                                }
                                
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>
<?php 
    include('../layout/footer.php'); 
?>
