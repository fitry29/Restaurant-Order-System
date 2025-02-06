<?php 
    include('../db/db_connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id'];
        $menu_name = mysqli_real_escape_string($conn, $_POST['name']);
        $menu_desc = mysqli_real_escape_string($conn, $_POST['menu_desc']);
        $price = floatval($_POST['price']);
        $category_id = intval($_POST['category_id']);
        $img = $_FILES['img'];

        // Handle image upload if a new image is provide
        if($img['size']>0){
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($img['name']);
            move_uploaded_file($img['tmp_name'],$target_file);
            $img_path = mysqli_real_escape_string($conn, $target_file);
            $img_query = ", img = '$img_path'";
        }else{
            $img_query ="";
        }

        //Update data into menu table
        $update_query = "UPDATE menu
            SET 
                menu_name = '$menu_name',
                menu_desc = '$menu_desc',
                price = '$price',
                category_id = '$category_id'
                $img_query
            WHERE id =$id;
        ";

        if(mysqli_query($conn, $update_query)){
            //REDIRECT to inventory page on success
            header("Location: /order-system/pages/menu-admin.php?update=success");
            exit();
        }else{
            echo "Error: " . mysqli_error($conn); 
        }
    }
    mysqli_close($conn);
?>