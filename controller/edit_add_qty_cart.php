<?php 
    include '../controller/session_check.php';
    include('../db/db_connection.php');

    If($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            $item_cart_id = $_GET['id'];

            $update_query = "UPDATE cart_item SET qty = qty + 1 WHERE id = $item_cart_id";

            if(mysqli_query($conn,$update_query)){
                //REDIRECT to inventory page on success
                header("Location: /order-system/pages/cart.php?update=success");
            }else{
                echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
?>