<?php   
require_once('connect.php');
session_start(); 
if(isset($_SESSION['login']) && $_SESSION['login'] == true){ 

         $log = mysqli_prepare($link, "DELETE FROM cart WHERE username = ?");
     mysqli_stmt_bind_param($log, "s", $_SESSION['uname']);
     mysqli_stmt_execute($log);
     header('location:cart.php');
 }

 else{
           header('location:login.php');
     }           
?>

