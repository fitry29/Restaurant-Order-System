<?php 
    include '../controller/session_check.php';

    $title = "Warongs's Admin ";
    include('../layout/header.php'); 
    include('../layout/sidenav-admin.php'); 
?>
<?php
    include('../db/db_connection.php');
    $query = "SELECT 
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
                category ON menu.category_id = category.id; 
    
    ";
    $result = mysqli_query($conn, $query);
?>
<div id="layoutSidenav_content">
    <main>
        <?php
            if(isset($_GET['update']) && $_GET['update'] == 'success'){
                
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Menu updated successfully!.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        ?>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Menu List</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Type of menu in this restaurant.</li>
            </ol>
            <div class="mb-2 col text-end"><a class="btn btn-primary" href="/order-system/pages/create-menu.php" >Create Menu</a></div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Menu Category
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Price (RM)</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Price (RM)</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php  foreach ($result as $r):?>
                                <tr>
                                    <td><?php echo $r['menu_name']?></td>
                                    <td><?php echo $r['menu_desc']?></td>
                                    <td>
                                        <a href="<?php echo $r['img']?>" target="_blank"> <u>Click here to see item image</u> </a>
                                        <!-- <img src="" class="img-fluid" style="width:150px" alt=""> -->
                                    </td>
                                    <td><?php echo $r['price']?></td>
                                    <td><?php echo $r['category_name']?></td>
                                    <td >
                                        <a href="/order-system/pages/edit-menu.php?id=<?php echo $r['id']?>" class="btn btn-success">Edit</a>
                                        <a href="" class="btn btn-danger">Remove</a>
                                    </td>

                                </tr>
                            <?php  endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
<?php 
    include('../layout/footer.php'); 
?>
