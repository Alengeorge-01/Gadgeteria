<?php
require_once('connect.php');

$table       = $_REQUEST['tablename'];
$name        = $_REQUEST['name'];
$productid   = $_REQUEST['productid'];
$image       = $_REQUEST['image'];
$price       = $_REQUEST['price'];
$si          = $_REQUEST['size'];
$description = $_REQUEST['description'];

$nameColumns = [
    'mobile'     => 'mname',
    'laptop'     => 'lname',
    'watch'      => 'wname',
    'television' => 'tname'
];

$redirects = [
    'mobile'     => 'mobile.php',
    'laptop'     => 'laptop.php',
    'watch'      => 'watch.php',
    'television' => 'tv.php'
];

$query = "select * from $table where product_id='$productid'";
$dup   = mysqli_query($link, $query);

if (mysqli_num_rows($dup) == 0) {
    echo "<script> alert('Product ID doesnt exist.'); window.location='edit.php'; </script>";
} elseif (isset($nameColumns[$table])) {
    $nameCol = $nameColumns[$table];

    $query1 = "update $table set $nameCol='$name' where product_id='$productid'";
    $query2 = "update $table set image='$image' where product_id='$productid'";
    $query3 = "update $table set size='$si' where product_id='$productid'";
    $query4 = "update $table set description='$description' where product_id='$productid'";
    $query5 = "update $table set price=$price where product_id='$productid'";

    mysqli_query($link, $query1);
    mysqli_query($link, $query2);
    mysqli_query($link, $query3);
    mysqli_query($link, $query4);
    mysqli_query($link, $query5);

    $redirect = $redirects[$table];
    echo "<script> window.location='$redirect'; </script>";
} else {
    echo "<script> alert('No Table Exists'); window.location='edit.php'; </script>";
}
?>


