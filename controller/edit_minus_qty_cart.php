<?php 
    include '../controller/session_check.php';
    include('../db/db_connection.php');

    If($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            $item_cart_id = $_GET['id'];

            $sql = "SELECT * FROM cart_item WHERE id = $item_cart_id";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result) === 1){
                $cart_items = mysqli_fetch_assoc($result);

                if($cart_items['qty'] > 1){
                    $update_query = "UPDATE cart_item SET qty = qty - 1 WHERE id = $item_cart_id";

                    if(mysqli_query($conn,$update_query)){
                        //REDIRECT to inventory page on success
                        header("Location: /order-system/pages/cart.php?update=success");
                    }else{
                        echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
                    }
                }
                else{
                    $delete_query = "DELETE FROM cart_item WHERE id = '$item_cart_id' ";

                    if(mysqli_query($conn, $delete_query)){
                        //REDIRECT to inventory page on success
                        header("Location: /order-system/pages/cart.php?remove=success");
                        exit();
                    }else{
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            }
        }
    }
    mysqli_close($conn);
?>