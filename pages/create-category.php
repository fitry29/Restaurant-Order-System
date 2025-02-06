<?php 
    include '../controller/session_check.php';

    $title = "Warongs's Admin ";
    include('../layout/header.php'); 
    include('../layout/sidenav-admin.php'); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <h2 class="mt-4">Add Category</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Insert type of menu in this restaurant.</li>
            </ol>
            <div class="card mb-4">
                <form class="p-4"  method="POST" action="../controller/submit_category.php"> 
                    <div class="mb-4">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>
<?php 
    include('../layout/footer.php'); 
?>
