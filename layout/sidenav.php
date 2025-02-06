<?php 
    include('../db/db_connection.php');

    $cart_id = $_SESSION['cart_id'];
    $sql = "SELECT COUNT(*) FROM cart_item WHERE cart_id = $cart_id";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_row($result);

?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light shadow" id="sidenavAccordion" >
        <div class="sb-sidenav-menu" style=" scrollbar-width: none;">
            <div class="nav mb-5" >
                
                <div class="sb-sidenav-menu-heading">Menu</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Menu
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="../pages/dashboard.php#rice-section">Rice</a>
                        <a class="nav-link" href="../pages/dashboard.php#mee-section">Mee</a>
                        <a class="nav-link" href="../pages/dashboard.php#tomyam-section">Tomyam</a>
                        <a class="nav-link" href="../pages/dashboard.php#sup-section">Soup</a>
                        <a class="nav-link" href="../pages/dashboard.php#veggie-section">Vegetables</a>
                        <div class="sb-sidenav-menu-heading">Sides</div>
                        <a class="nav-link" href="../pages/dashboard.php#ayam-section">Ayam</a>
                        <a class="nav-link" href="../pages/dashboard.php#daging-section">Daging</a>
                        <a class="nav-link" href="../pages/dashboard.php#seafood-section">Seafood</a>
                        <a class="nav-link" href="../pages/dashboard.php#others-section">Others</a>
                        <div class="sb-sidenav-menu-heading">Beverages</div>
                        <a class="nav-link" href="../pages/dashboard.php#minuman-section">Minuman</a>
                    </nav>
                </div>
                <hr>
                <div class="sb-sidenav-menu-heading">Order</div>
                <a class="nav-link" href="../pages/cart.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Cart<span class="badge text-bg-primary ms-2"><?php echo $row[0]  ?></span>
                </a>
                <a class="nav-link" href="../pages/my-order.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                    My Order
                </a>


               
    </nav>
</div>