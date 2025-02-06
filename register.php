<?php
    include('db/db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register Warong's</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <?php
                    if(isset($_GET['pass']) && $_GET['pass'] == 'false'){
                        
                        echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Password not same!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                    }
                ?>
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-4 mt-5 p-3">
                                    <div class="card-title"><h3 class="text-center font-weight-light my-5">Join with <b>Warong's</b> !</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="/order-system/controller/create_user.php" >
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputName" type="text" name="name" placeholder="name@example.com" />
                                                <label for="inputName">Name</label>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="retype_password" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column align-items-center justify-content-between mt-4 mb-0 gap-2">
                                                <input type="submit" class="btn btn-primary col-6" value="Register">
                                            </div>
                                        </form>
                                        <hr>
                                        <div class="text-center py-3">
                                            <div class="small"><a href="index.php">Have an account? Go to login</a></div>
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
