<?php 
    include '../controller/session_check.php';
    include('../db/db_connection.php');

    If($_SERVER['REQUEST_METHOD'] == "GET"){
        If(isset($_GET['id'])){
            $menu_id = $_GET['id'];
            $cust_id = $_SESSION['user_id'];
            $cart_id = $_SESSION['cart_id'];

            $sql = "SELECT * FROM cart_item WHERE cart_id = $cart_id AND menu_id = $menu_id";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 0){
                $sql_cart_item = "INSERT INTO cart_item (cart_id, menu_id, qty) 
                                    VALUES ('$cart_id','$menu_id', '1')";

                //REDIRECT to inventory page on success
                if(mysqli_query($conn, $sql_cart_item)){
                    //REDIRECT to inventory page on success
                    header("Location: /order-system/pages/dashboard.php?add=success");
                    exit;
                }else{
                    echo "Error: " . $sql_cart_item . "<br>" . mysqli_error($conn); 
                }
            }else{
                while($cart_items = mysqli_fetch_assoc($result)){
                    $qty_item = $cart_items['qty'];
                    if($qty_item > 0){
                        $new_qty = $qty_item + 1;
                        $sql_cart_item_update = "UPDATE cart_item SET qty = $new_qty WHERE cart_id = $cart_id AND menu_id = $menu_id";

                        if(mysqli_query($conn, $sql_cart_item_update)){
                            header("Location: /order-system/pages/dashboard.php?update=success");
                            exit;
                        }else{
                            echo "Error: " . $sql_cart_item_update . "<br>" . mysqli_error($conn);
                        }
                    }
                }
            }
        }
    }
    mysqli_close($conn);

?>