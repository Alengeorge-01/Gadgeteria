<?php
require_once('connect.php');
session_start();
    $n1=$_REQUEST['n1'];
    $_SESSION['quan']=$_REQUEST['quantity'];

    $log = mysqli_prepare($link, " select * from mobile where product_id = ?");
    mysqli_stmt_bind_param($log, "s", $n1);
    mysqli_stmt_execute($log);
    $log1 = mysqli_stmt_get_result($log);
    if(mysqli_num_rows( $log1) > 0 ){
        while($row = mysqli_fetch_assoc($log1)) {
            $query1 = mysqli_prepare($link, "INSERT INTO cart(username, product_id, name, price, quantity) values (?,?,?,?,?)");
            mysqli_stmt_bind_param($query1, "sssii", $_SESSION['uname'], $row['product_id'], $row['mname'], $row['price'], $_SESSION['quan']);
            mysqli_stmt_execute($query1);
            header("location:mobile.php");

    }
    }
    ?>
