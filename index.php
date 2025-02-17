<?php
    include('db/db_connection.php');
    session_start();
    
    if(isset($_GET['table_no'])){
        $_SESSION['table_no'] = $_GET['table_no'];
        $table_no = $_SESSION['table_no'];
    }

    $query =  "SELECT id, email, type FROM customers";
    $result = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($result);
    
    //check if the user is logged in by verifying sessions variables
    if(isset($_SESSION['user_id'])){

        if($_SESSION['user_id'] == $user['id'] && $user['type'] == "admin"){

            //if not logged in, redirect to login page
            header("Location: /order-system/pages/dashboard-admin.php");
            exit();

        }
        else{
            //if not logged in, redirect to login page
            header("Location: /order-system/pages/dashboard.php");
            exit();
            
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Warong's</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <?php
                    if(isset($_GET['login']) && $_GET['login'] == 'fail'){
                        
                        echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Credintial not correct!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                    }
                ?>
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 p-3">
                                    <div class="card-title"><h3 class="text-center font-weight-light my-5">Welcome Back to <b>Warong's</b> !</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="/order-system/controller/auth.php">
                                            <?php 
                                                    if(isset($_GET['table_no'])){
                                                        echo "                                            
                                                        <div class='form mb-3'>
                                                            <label for='table_no'>Table no : "  .$table_no ."</label>
                                                        </div>";
                                                    }
                                            ?>
                                            <input class="form-control" id="table_no" type="hidden" name="table_no" value = "<?php echo $table_no?>"/>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-5">
                                                <input class="form-control" id="inputPassword"  name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex flex-column align-items-center justify-content-between mt-4 mb-0 gap-2">
                                                <input type="submit" class="btn btn-primary col-6" value="Login">
                                                <!-- <input type="submit" class="btn btn-light border border-dark col-4" value="Login as Guest"> -->
                                                <a href="/order-system/controller/auth_guest.php" class="btn btn-light border border-dark col-md-4 col-7">Login as Guest</a>
                                            </div>
                                        </form>
                                        <hr>
                                        <div class="text-center py-3">
                                            <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
<?php include('layout/footer.php'); ?>
