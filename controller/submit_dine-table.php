<?php
    include('../db/db_connection.php');

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $table_name = mysqli_real_escape_string($conn, $_POST['name']);


        //Insert data into inventory table
        $sql = "INSERT INTO dine_table (table_name)
                VALUES ('$table_name')";

        if(mysqli_query($conn, $sql)){
            //REDIRECT to inventory page on success
            header("Location: /order-system/pages/dine-table.php?create=success");
            exit;
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>