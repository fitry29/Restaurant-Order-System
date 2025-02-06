<?php 
    include '../controller/session_check.php';
    include('../db/db_connection.php');

    If($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            $table_id = $_GET['id'];

            $update_stat = "UPDATE dine_table SET table_stat = 'open' WHERE id = $table_id";

            if(mysqli_query($conn,$update_stat)){
                header("Location: /order-system/pages/dine-table.php");
            }else{
                echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
            }
        }
    }
    
    mysqli_close($conn);
?>