<?php 
    include('../db/db_connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $retype_pass = mysqli_real_escape_string($conn, $_POST['retype_password']);

        if($name == "admin" && $email == "admin@warong.com"){
            $type = 'admin';

            if($retype_pass == $pass){
                $sql = "INSERT INTO customers (email,name,password,type) VALUES ('$email', '$name' , '$pass', '$type')";
    
                if(mysqli_query($conn,$sql)){
                    header("Location: /order-system/login.php");
                    exit;
                }else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }else{
                header("Location: /order-system/register.php?pass=false");
                exit();
            }
        }else{
            $type = 'user';
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
            $hashed_repass = password_hash($retype_pass, PASSWORD_DEFAULT);

            if($retype_pass == $pass){
                $sql = "INSERT INTO customers (email,name,password,type) VALUES ('$email', '$name' , '$hashed_pass', '$type')";
    
                if(mysqli_query($conn,$sql)){
                    header("Location: /order-system/index.php");
                    exit;
                }else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }else{
                header("Location: /order-system/register.php?pass=false");
                exit();
            }
        }


        
    }
    mysqli_close($conn);

?>