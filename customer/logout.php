<?php
 session_start(); 
 unset($_SESSION['customer_id']);
 unset($_SESSION['custName']);
 unset($_SESSION['custEmail']);
 unset($_SESSION['custTel']);
 unset($_SESSION['address']);
 unset($_SESSION['items']);
 session_destroy();
 header("Location: ../index.php");
exit;

?>