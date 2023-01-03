<?php session_start(); 

 unset($_SESSION['staff_id']);
 unset($_SESSION['staffName']);
 unset($_SESSION['staffEmail']);
 unset($_SESSION['staffType']);
 unset($_SESSION['admin_id']);
 unset($_SESSION['department_id']);
 session_destroy();

 header("Location: ../loginStaff.php");
 exit;

?>