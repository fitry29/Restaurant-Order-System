<?php 
    include '../controller/session_check.php';
    include('../db/db_connection.php');

    If($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            $table_id = $_GET['id'];

            $update_query = "UPDATE dine_table SET table_stat = 'used'  WHERE id = $table_id";

            if(mysqli_query($conn,$update_query)){
                $sql = "SELECT * FROM dine_table WHERE id = $table_id";
                $result = mysqli_query($conn,$sql);

                $dine_table = mysqli_fetch_assoc($result);

                $table_name = $dine_table['table_name'];

                //REDIRECT to inventory page on success
                header("Location: /order-system/pages/dine-table.php?table_name=$table_name");
            }else{
                echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
            }
        }
    }
    mysqli_close($conn);
?>