<?php 
    include '../controller/session_check.php';

    $title = "Admin Warong's";
    include('../layout/header.php'); 
    include('../layout/sidenav-admin.php'); 
?>
<?php
    include('../db/db_connection.php');
    $query = " SELECT * FROM dine_table";
    $result = mysqli_query($conn, $query);
?>
<div id="layoutSidenav_content">
    <main>
        <?php
            if(isset($_GET['create']) && $_GET['create'] == 'success'){
                
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            New table added successfully!.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            if(isset($_GET['table_name'])){
                $table_name = $_GET['table_name'];
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            http://localhost/order-system?table_no='.$table_name .'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        ?>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Dine Table Name</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Table inside restaurant.</li>
            </ol>
            <div class="mb-2 col text-end"><a class="btn btn-primary" href="/order-system/pages/create-dine-table.php" >Add Table</a></div>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php  foreach ($result as $r):?>
                                <tr>
                                    <td><?php echo $r['id']?></td>
                                    <td><?php echo $r['table_name']?></td>
                                    <td>
                                        <?php
                                            if($r['table_stat'] == 'open'){
                                                echo '<a href = "../controller/edit_table_stat.php?id='.$r['id'].'" class=" btn btn-primary col text-center fw-bold">'. strtoupper($r['table_stat']). '</a>';
                                            }else{
                                                echo '<a href = "../controller/edit_table_stat.php?id='.$r['id'].'" class="btn btn-secondary col text-center fw-bold">'. strtoupper($r['table_stat']). '</a>';
                                               
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="../controller/generate_link_order.php?id=<?php echo $r['id']?>" class="btn btn-success" >Generate Order Link</a>
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
