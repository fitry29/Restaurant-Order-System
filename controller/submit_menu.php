<?php 
    include('../db/db_connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $menu_name = mysqli_real_escape_string($conn, $_POST['name']);
        $menu_desc = mysqli_real_escape_string($conn, $_POST['menu_desc']);
        $price = floatval($_POST['price']);
        $category_id = intval($_POST['category_id']);
    

        // Handle image upload
        if(isset($_FILES['img']) && $_FILES['img']['error'] == 0){
            $img_name = $_FILES['img']['name'];
            $img_tmp_name = $_FILES['img']['tmp_name'];
            $img_path = '../uploads/'. basename($img_name);

            //Ensure 'uploads directory exist and writeable
            if(move_uploaded_file($img_tmp_name, $img_path)){
                $img = $img_path;
            }else{
                echo "Failed to upload image.";
                exit;
            }
        }else{
            $img = null;
        }

        //Insert data into inventory table
        $sql = "INSERT INTO menu (menu_name, menu_desc, img, price, category_id)
                VALUES ('$menu_name', '$menu_desc', '$img', '$price', '$category_id');
        ";

        if(mysqli_query($conn, $sql)){
            //REDIRECT to inventory page on success
            header("Location: /order-system/pages/menu-admin.php");
            exit;
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
        }
    }
    mysqli_close($conn);
?>