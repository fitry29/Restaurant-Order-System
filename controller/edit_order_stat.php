<?php 
    include '../controller/session_check.php';
    include('../db/db_connection.php');

    If($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            $order_id = $_GET['id'];
            $table_id = $_GET['table_id'];

            $update_stat = "UPDATE orders SET orders_stat = 'completed' WHERE id = $order_id";

            if(mysqli_query($conn,$update_stat)){
                $update_table = "UPDATE dine_table SET table_stat ='open' WHERE id = $table_id";

                if(mysqli_query($conn,$update_table)){
                    header("Location: /order-system/pages/order-admin.php");
                }
                else{
                    echo "Error: " . $update_table . "<br>" . mysqli_error($conn);
                }
            }else{
                echo "Error: " . $update_stat . "<br>" . mysqli_error($conn);
            }
        }
    }
    
    mysqli_close($conn);
?>