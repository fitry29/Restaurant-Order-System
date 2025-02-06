<?php 
    include '../controller/session_check.php';
    include('../db/db_connection.php');

    If($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            $item_cart_id = $_GET['id'];

            $remove_query = "DELETE FROM cart_item WHERE id = '$item_cart_id' ";

            if(mysqli_query($conn,$remove_query)){
                //REDIRECT to inventory page on success
                header("Location: /order-system/pages/cart.php?remove=success");
            }else{
                echo "Error: " . $remove_query . "<br>" . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
?>