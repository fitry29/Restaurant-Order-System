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

    $menu_id = $_GET['id'];
    $query2 = " SELECT 
                    menu.id,
                    menu.menu_name, 
                    menu.menu_desc, 
                    menu.img, 
                    menu.price,
                    menu.category_id,
                    category.name AS category_name
                FROM 
                    menu
                JOIN 
                    category ON menu.category_id = category.id
                WHERE
                    menu.id = ".$menu_id."; 
            ";
    $result2 = mysqli_query($conn, $query2);
    $menu_data = mysqli_fetch_assoc($result2);
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <h2 class="mt-4">Add Menu</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Adding variation of foods to menu.</li>
            </ol>
            <div class="card mb-4">
                <form class="p-4"  method="POST" enctype="multipart/form-data" action="/order-system/controller/submit_edit_menu.php">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($menu_data['id']) ?>" > 
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="Enter menu name" value="<?php echo htmlspecialchars($menu_data['menu_name'])  ?>" required>
                    </div>                        
                    <div class="mb-3">
                        <label for="menu-desc" class="form-label">Description</label>
                        <textarea class="form-control" id="menu-desc" name="menu_desc" placeholder="Write some item description..." ><?php echo htmlspecialchars($menu_data['menu_desc']) ?>
                        </textarea>
                    </div>
                    <div class="mb-3">
                            <label for="formFile" class="form-label">Current Image Item</label><br>
                            <img src="<?php echo htmlspecialchars($menu_data['img'])?>" class="rounded img-fluid" style="width: 200px;" alt="...">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input type="file" id="formFile" name="img"  class="form-control" accept="image/* ">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="<?php echo htmlspecialchars($menu_data['price'])  ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="category-id"  class="form-label">Select Category</label>
                        <select class="form-select" id="category-id" name="category_id" required>
                            <option value="<?php echo htmlspecialchars($menu_data['category_id'])?>"> <?php echo htmlspecialchars($menu_data['category_name'])?> </option>
                            <?php   
                                while($row = mysqli_fetch_assoc($result)){
                                    $selected = ($menu_data['category_id'] == $row['id']) ? 'selected' :'';
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
