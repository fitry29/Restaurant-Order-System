<?php 
    include('../db/db_connection.php');
    session_start();
    
    if(isset($_GET['table_no'])){
        $_SESSION['table_no'] = $_GET['table_no'];
        $table_no = $_SESSION['table_no'];
    }

    $query = "SELECT id FROM customers ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) === 1){
        $last = mysqli_fetch_assoc($result);

        $getId = $last['id'] + 1;

        $email = 'guest'.$getId.'@warong.com';
        $name = 'guest'.$getId;
        $pass = "";
        $type = "guest";

        $sql = "INSERT INTO customers (email,name,password,type) VALUES ('$email', '$name' , '$pass', '$type')";
    
        if(mysqli_query($conn,$sql)){

            $sql2 = "SELECT * FROM customers WHERE email = '$email'";
            $result2 = mysqli_query($conn, $sql2);

            if(mysqli_num_rows($result2) === 1){
                $user = mysqli_fetch_assoc($result2);
    
                if($user['type'] == "guest"){
                    session_start();
    
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];

                    $userId = $_SESSION['user_id'];

                    $insert_cart_sql = "INSERT INTO cart (customer_id, stats)
                    VALUES ('$userId', 'active');
                    ";

                    if(mysqli_query($conn, $insert_cart_sql)){
                        // Select from card where user id
                        $sql_cart = "SELECT * FROM cart WHERE customer_id = $userId AND stats = 'active'";
                        $cart_result = mysqli_query($conn, $sql_cart);

                        if(mysqli_num_rows($cart_result) === 1){
                            //while loop to check one by one
                          $cart = mysqli_fetch_assoc($cart_result);          
                            session_start();

                            $_SESSION['cart_id'] = $cart['id'];
                            header("Location: /order-system/pages/dashboard.php");
                            exit;
                        }

                        //REDIRECT to inventory page on success
                        header("Location: /order-system/pages/dashboard.php");
                        exit;
                    }else{
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                }else{
                    header('Location: /order-system/login.php?login=fail');
                }
            }
            

        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);

?>