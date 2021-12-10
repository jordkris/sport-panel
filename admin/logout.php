<?php 
session_start();
  // unset($_SESSION["username"]);
 //  unset($_SESSION["loggedin"]);
   //unset($_SESSION['name']);
   
   session_destroy();
   echo "<script>alert('successfully logged out');</script>";
   echo "<script>window.location.href='login.php';</script>";
   
   
?>