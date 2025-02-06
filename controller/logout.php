<?php 
session_start();
session_unset();
session_destroy();
header("Location: /order-system/index.php");
exit();
?>