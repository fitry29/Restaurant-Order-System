<?php
    include '../controller/session_check.php';

    $title = "Warongs's Admin ";
    include('../layout/header.php'); 
    include('../layout/sidenav-admin.php'); 
?>
<?php
    include('../db/db_connection.php');
    $query = " SELECT * FROM category";
    $result = mysqli_query($conn, $query);
?>
<div id="layoutSidenav_content">
    <main>
        <?php
            if(isset($_GET['create']) && $_GET['create'] == 'success'){
                
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Category updated successfully!.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        ?>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Menu Category</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Type of menu in this restaurant.</li>
            </ol>
            <div class="mb-2 col text-end"><a class="btn btn-primary" href="/order-system/pages/create-category.php" >Create Category</a></div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Menu Category
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php  foreach ($result as $r):?>
                                <tr>
                                    <td><?php echo $r['id']?></td>
                                    <td><?php echo $r['name']?></td>
                                    <td >
                                        <a href="../controller/delete-category.php?id=<?php echo $r['id']?>" class="btn btn-danger">Remove</a>
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
