<?php 
    include '../controller/session_check.php';
    $title = "Warong's";
    include('../layout/header.php'); 
    include('../layout/sidenav.php'); 

    include('../db/db_connection.php');

    $user_id = $_SESSION['user_id'];
    $cart_id = $_SESSION['cart_id'];
    $table_name = $_SESSION['table_no'];

    $query_get_cart_item = "SELECT
                        cart_item.id,
                        customers.id AS cust_id,
                        cart_id,
                        menu_id,
                        menu.menu_name,
                        menu.img,
                        menu.price,
                        qty
                    FROM cart_item
                    INNER JOIN cart ON cart_item.cart_id = cart.id
                    INNER JOIN customers ON cart.customer_id = customers.id
                    INNER JOIN menu ON cart_item.menu_id = menu.id
                    WHERE cart_id = $cart_id AND customers.id = $user_id ;
                    
                    ";

    $cart_result = mysqli_query($conn, $query_get_cart_item);

    $total_price_query = "SELECT SUM(menu.price * cart_item.qty) AS total 
                    FROM cart_item
                    INNER JOIN cart ON cart_item.cart_id = cart.id
                    INNER JOIN menu ON cart_item.menu_id = menu.id
                    WHERE cart_item.cart_id = $cart_id; 
                    ";
    $result_query = mysqli_query($conn, $total_price_query);

    $row = mysqli_fetch_assoc($result_query);

    $total_result = $row['total'];

?>
<div id="layoutSidenav_content">
    <main>
        <?php
            if(isset($_GET['update']) && $_GET['update'] == 'success'){
                
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Quantity updated successfully!.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            if(isset($_GET['remove']) && $_GET['remove'] == 'success'){
                
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Your item is removed successfully!.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        ?>
        <div class="container-fluid px-4">
            <h2 class="mt-4">My Cart</h2>
            
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table ">
                                <thead class="table-white" >
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_result as $r):?>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="<?php echo $r['img']?>" class="img-thumbnail" alt="...">
                                                </div>
                                                <div class="col-md-6 col ">
                                                    <div class="row fw-bold mb-2"><?php echo $r['menu_name']?></div>
                                                    <div class="row mb-2">Quantity: </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-5 col">
                                                            <div class="row">
                                                                <a href="../controller/edit_minus_qty_cart.php?id=<?php echo $r['id']?>" class="col fs-6 text-dark text-center" ><i class="fa fa-minus" ></i></a>
                                                                <div class="col text-center"><?php echo $r['qty']?></div>
                                                                <a href="../controller/edit_add_qty_cart.php?id=<?php echo $r['id']?>" class="col fs-6 text-dark text-center" ><i class="fa fa-add" ></i></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <a class="row text-danger" href="../controller/remove_cart_item.php?id=<?php echo $r['id']?>" >Remove</a>
                                                </div>
                                               
                                            </div>
                                        </td>
                                        <td class="col-2"><?php echo $r['price']?></td>
                                        <td class="col-2">RM <?php echo number_format($r['price']*$r['qty'], 2) ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 p-4">
                        <div class="row">
                            <b class="col" >Summary</b>
                            <div class="col-4">Table No: <b><?php echo ucwords($table_name) ?></b></div>
                        </div>
                        <hr>
                        <div class="row justify-content-between">
                            <p class="col" >Subtotal</p>
                            <p class="col-4">RM <?php $subtotal = number_format($total_result, 2); echo $subtotal ?></p>
                        </div>
                        <div class="row justify-content-between">
                            <p class="col" >Tax 6% :</p>
                            <p class="col-4">RM <?php $tax =  number_format($total_result * 0.06, 2); echo $tax ?></p>
                        </div>
                        <hr>
                        <div class="row justify-content-between">
                            <p class="col" ><b>Total</b> :</p>
                            <p class="col-4 fw-bold">RM <?php echo  number_format($subtotal + $tax, 2) ?></p>
                        </div>
                        <form action="../controller/create_order.php" method="POST">
                            <input type="hidden" name="table_name" id="table_name" value="<?php echo $table_name ?>">
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id ?>">
                            <input type="hidden" name="cart_id" id="cart_id" value="<?php echo $cart_id ?>">
                            <input type="hidden" name="tax" id="tax" value="<?php echo $tax ?>">
                            <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $subtotal ?>">
                            <div class="row" >
                                <button type="submit" class="btn btn-success">Confirm Order</input>
                            </div>            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php 
    include('../layout/footer.php'); 
?>
