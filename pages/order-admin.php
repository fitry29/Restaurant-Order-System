<?php 
    include '../controller/session_check.php';
    $title = "Warong's";
    include('../layout/header.php'); 
    include('../layout/sidenav-admin.php'); 

    include('../db/db_connection.php');

    // $user_id = $_SESSION['user_id'];
    // $cart_id = $_SESSION['cart_id'];
    // $table_name = $_SESSION['table_no'];

    $query_order = "SELECT 
                        dine_table.table_name,
                        dine_table.table_stat,
                        orders.orders_stat,
                        orders.id,
                        orders.table_id,
                        orders.create_at,
                        orders.customer_id,
                        customers.name,
                        orders.total_amount,
                        orders.cart_id
                    FROM orders
                    INNER JOIN dine_table ON orders.table_id = dine_table.id 
                    INNER JOIN customers ON orders.customer_id = customers.id
                    ORDER BY orders.create_at DESC;
                    ";

    $order_result = mysqli_query($conn, $query_order);

?>
<div id="layoutSidenav_content">
    <main>
        <?php
            // if(isset($_GET['update']) && $_GET['update'] == 'success'){
                
            //     echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
            //                 Quantity updated successfully!.
            //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //             </div>';
            // }
            // if(isset($_GET['remove']) && $_GET['remove'] == 'success'){
                
            //     echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
            //                 Your item is removed successfully!.
            //                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //             </div>';
            // }
        ?>
        <div class="container-fluid px-4">
            <h2 class="mt-4">All Order</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Price show is include 6% tax.</li>
            </ol>
            <div class="row mt-5">
                <div class="col-md-10">
                
                <?php  foreach ($order_result as $r):?>   
                    <div class="card mb-4 p-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="row">
                                        <h5><?php echo ucwords($r['name'])?></h5>
                                    </div>
                                    <div class="row">
                                        <h6>Order No: <?php echo $r['id']?></h6>
                                    </div>
                                    <div class="row">
                                        <p>Table No: <?php echo $r['table_name']?></p>
                                    </div>
                                    <div class="row">
                                        <?php 
                                            $order_cart_id = $r['cart_id'];
                                            $query_order_items = "SELECT 
                                                                    cart_item.cart_id,
                                                                    cart_item.menu_id,
                                                                    cart_item.qty,
                                                                    menu.menu_name
                                                                    FROM cart_item
                                                                    INNER JOIN menu ON cart_item.menu_id = menu.id
                                                                    WHERE cart_item.cart_id = $order_cart_id
                                                                    ";
                                            $order_item_result = mysqli_query($conn, $query_order_items);
                                        ?>
                                       
                                       <?php  foreach ($order_item_result as $order_item):?>
                                            <div><?php echo $order_item['qty']?>x <?php echo $order_item['menu_name']?></div>
                                        <?php  endforeach; ?>
                                        
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="h-100 d-flex flex-column align-items-end justify-content-between">
                                        <div class="fw-bold" >Created At : <?php echo $r['create_at']?></div>
                                        <?php  
                                                
                                            if($r['orders_stat'] == 'not_pay'){
                                                echo '<a href="../controller/edit_order_stat.php?id='.$r['id'].'&table_id='.$r['table_id'].'" class="btn btn-warning">Not Pay</a>';
                                            }else if($r['orders_stat'] == 'completed'){
                                                echo '<a href="#" class="btn btn-success">Completed</a>';
                                            }
                                        ?>
                                        <div class="fw-bold">Total Payment : RM <?php echo $r['total_amount']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
<?php 
    include('../layout/footer.php'); 
?>
