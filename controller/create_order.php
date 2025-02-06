<?php 
    include('../db/db_connection.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $customer_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $table_name =  $_POST['table_name'];
        $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
        $subtotal = floatval( $_POST['subtotal']);
        $tax = floatval( $_POST['tax']);

        //Get table id first
        $get_table_id_query = "SELECT * FROM dine_table WHERE table_name = '$table_name'";
        $result_table_id = mysqli_query($conn,$get_table_id_query);

        $dine_table = mysqli_fetch_assoc($result_table_id);
        $table_id = $dine_table['id'];

        //calculate payment with tax
        $total_payment = $subtotal + $tax;

        $sql = "INSERT INTO orders (table_id, customer_id, total_amount, cart_id)
                VALUES ('$table_id', '$customer_id', '$total_payment', '$cart_id')";
        
        if(mysqli_query($conn, $sql)){

            $update_cart_query = "UPDATE cart SET stats = 'done' WHERE id = $cart_id";
            
            if(mysqli_query($conn, $update_cart_query)){

                $insert_cart_sql = "INSERT INTO cart (customer_id, stats)
                VALUES ('$customer_id', 'active');
                ";

                if(mysqli_query($conn, $insert_cart_sql)){
                    // Select from card where user id
                    $sql_cart = "SELECT * FROM cart WHERE customer_id = $customer_id AND stats = 'active'";
                    $cart_result = mysqli_query($conn, $sql_cart);

                    if(mysqli_num_rows($cart_result) === 1){
                        //while loop to check one by one
                    $cart = mysqli_fetch_assoc($cart_result);          
                        session_start();

                        $_SESSION['cart_id'] = $cart['id'];
                        header("Location: /order-system/pages/my-order.php");
                        exit;
                    }
                }else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
        }
    }
    mysqli_close($conn);
?>