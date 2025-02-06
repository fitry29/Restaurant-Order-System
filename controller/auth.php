<?php 
    include('../db/db_connection.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        session_start();
    
        if(isset($_GET['table_no'])){
            $_SESSION['table_no'] = $_GET['table_no'];
            $table_no = $_SESSION['table_no'];
        }

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        $query = "SELECT * FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) === 1){
            $user = mysqli_fetch_assoc($result);

            if($password == $user['password'] && $user['type'] == "admin"){
                session_start();

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];

                header("Location: /order-system/pages/dashboard-admin.php");
                exit();
            }
            else if(password_verify($password,$user['password']) && $user['type'] == "user"){
                session_start();
    
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];

                $userId = $_SESSION['user_id'];
                
                // Select from card where user id
                $sql_cart = "SELECT * FROM cart WHERE customer_id = $userId AND stats = 'active' ";
                $cart_result = mysqli_query($conn, $sql_cart);

                //Check if there number of row from result
                if(mysqli_num_rows($cart_result) > 0){
                    //while loop to check one by one
                    while($cart = mysqli_fetch_assoc($cart_result)){
                            session_start();

                            $_SESSION['cart_id'] = $cart['id'];
                            header("Location: /order-system/pages/dashboard.php");
                            exit;
                    }  
                }else{

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
                }
            }
            else{
                header('Location: /order-system/index.php?login=fail&table_no='.$_SESSION['table_no']);
            }
        }else{
            header('Location: /order-system/index.php?login=fail&table_no='.$_SESSION['table_no']);
        }
    }
    mysqli_close($conn);
?>