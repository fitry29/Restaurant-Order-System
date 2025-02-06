<?php 
    include '../controller/session_check.php';
    $title = "Warong's";
    include('../layout/header.php'); 
    include('../layout/sidenav.php'); 

    include('../db/db_connection.php');
    $query = "SELECT 
                menu.id,
                menu.menu_name, 
                menu.menu_desc, 
                menu.img, 
                menu.price,
                menu.category_id,
                category.name AS category_name
            FROM 
                menu
            JOIN 
                category ON menu.category_id = category.id ";

    $q_rice = $query . "WHERE category.name = 'Rice' ";
    $result_rice = mysqli_query($conn, $q_rice);

    $q_mee = $query . "WHERE category.name = 'Mee' ";
    $result_mee = mysqli_query($conn, $q_mee);

    $q_tomyam = $query . "WHERE category.name = 'Tomyam' ";
    $result_tomyam = mysqli_query($conn, $q_tomyam);

    $q_sup = $query . "WHERE category.name = 'Soup' ";
    $result_sup = mysqli_query($conn, $q_sup);

    $q_veggie = $query . "WHERE category.name = 'Vegetables' ";
    $result_veggie = mysqli_query($conn, $q_veggie);

    $q_ayam = $query . "WHERE category.name = 'Ayam' ";
    $result_ayam = mysqli_query($conn, $q_ayam);

    $q_dgg = $query . "WHERE category.name = 'Daging' ";
    $result_dgg = mysqli_query($conn, $q_dgg);

    $q_sfd = $query . "WHERE category.name = 'Seafood' ";
    $result_sfd = mysqli_query($conn, $q_sfd);

    $q_others = $query . "WHERE category.name = 'Others' ";
    $result_others = mysqli_query($conn, $q_others);

    $q_minuman = $query . "WHERE category.name = 'Minuman' ";
    $result_minuman = mysqli_query($conn, $q_minuman);


?>
<div id="layoutSidenav_content">
    <main>
        <?php
            if(isset($_GET['add']) && $_GET['add'] == 'success'){
                
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Cart updated successfully!.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            if(isset($_GET['update']) && $_GET['update'] == 'success'){
                
                echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Cart updated successfully!.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
        ?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Menu</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Happy order!</li>
            </ol>
            <p id="rice-section">Rice</p>
            <hr class="mb-4">
            <div class="row equal-height-row" >
                <?php foreach ($result_rice as $rice):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $rice['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $rice['menu_name']?></h5>
                            <p><?php echo $rice['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-start justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $rice['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $rice['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p>Mee</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_mee as $mee):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $mee['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $mee['menu_name']?></h5>
                            <p><?php echo $mee['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $mee['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $mee['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="tomyam-section">Tomyam</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_tomyam as $tom):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $tom['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $tom['menu_name']?></h5>
                            <p><?php echo $tom['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $tom['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $tom['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="sup-section">Sup</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_sup as $sup):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $sup['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $sup['menu_name']?></h5>
                            <p><?php echo $sup['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $sup['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $sup['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="veggie-section">Veggie</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_veggie as $v):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $v['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $v['menu_name']?></h5>
                            <p><?php echo $v['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $v['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $v['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="ayam-section">Ayam</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_ayam as $a):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $a['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $a['menu_name']?></h5>
                            <p><?php echo $a['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $a['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $a['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="daging-section">Daging</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_dgg as $dgg):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $dgg['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $dgg['menu_name']?></h5>
                            <p><?php echo $dgg['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $dgg['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $dgg['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="seafood-section">Seafood</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_sfd as $sfd):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $sfd['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $sfd['menu_name']?></h5>
                            <p><?php echo $sfd['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $sfd['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $sfd['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="others-section">Others</p>
            <hr class="mb-4">
            <div class="row equal-height-row" id="mee-section" >
                <?php foreach ($result_others as $others):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $others['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $others['menu_name']?></h5>
                            <p><?php echo $others['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $others['price']?></h5>
                            <div class="btn btn-primary rounded-circle ">
                                <a href="../controller/add_to_cart.php?id=<?php echo $others['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>

            <p id="minuman-section">Minuman</p>
            <hr class="mb-4">
            <div class="row equal-height-row"  >
                <?php foreach ($result_minuman as $m):?>
                <div class="col-xl-4 col-md-6 col-6 equal-height-col">
                    <div class="card mb-4 ">
                        <img src="<?php echo $m['img']?>"  class="card-img-top border-bottom" style="object-fit: contain; height:200px;"  alt="...">
                        <div class="card-body">
                            <h5><?php echo $m['menu_name']?></h5>
                            <p><?php echo $m['menu_desc']?></p>
                        </div>
                        <div class="d-flex flex-column flex-xl-row flex-md-row align-items-center justify-content-between gap-2 p-3">
                            <h5>RM <?php echo $m['price']?></h5>
                            <div class="btn btn-primary rounded-circle">
                                <a href="../controller/add_to_cart.php?id=<?php echo $m['id']?>" class="text-light" ><i class="fas fa-add"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>


        </div>
    </main>
<?php 
    include('../layout/footer.php'); 
?>
