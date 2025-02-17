<?php 
    include '../controller/session_check.php';

    $title = "Warongs's Admin ";
    include('../layout/header.php'); 
    include('../layout/sidenav-admin.php'); 
?>
<?php
    include('../db/db_connection.php');
    $query = "SELECT 
                customers.id,
                customers.name, 
                customers.email, 
                customers.type
            FROM 
                customers
            WHERE customers.type = 'user' OR customers.type = 'guest';
        ";
        
    $result = mysqli_query($conn, $query);
?>
<div id="layoutSidenav_content">
    <main>
        <?php
            // if(isset($_GET['update']) && $_GET['update'] == 'success'){
                
            //     echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
            //                 Menu updated successfully!.
            //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //             </div>';
            // }
        ?>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Customer List</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List of customers.</li>
            </ol>
            <!-- <div class="mb-2 col text-end"><a class="btn btn-primary" href="/order-system/pages/create-menu.php" >Create Menu</a></div> -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Customer List
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php  foreach ($result as $r):?>
                                <tr>
                                    <td><?php echo $r['id']?></td>
                                    <td><?php echo $r['name']?></td>
                                    <td><?php echo $r['email']?></td>
                                    <td><?php echo $r['type']?></td>

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
