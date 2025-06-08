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

$query = mysqli_prepare($link, "select * from $table where product_id=?");
mysqli_stmt_bind_param($query, "s", $productid);
mysqli_stmt_execute($query);
$dup   = mysqli_stmt_get_result($query);

if (mysqli_num_rows($dup) == 0) {
    echo "<script> alert('Product ID doesnt exist.'); window.location='edit.php'; </script>";
} elseif (isset($nameColumns[$table])) {
    $nameCol = $nameColumns[$table];

    $query1 = mysqli_prepare($link, "update $table set $nameCol=? where product_id=?");
    mysqli_stmt_bind_param($query1, "ss", $name, $productid);
    mysqli_stmt_execute($query1);

    $query2 = mysqli_prepare($link, "update $table set image=? where product_id=?");
    mysqli_stmt_bind_param($query2, "ss", $image, $productid);
    mysqli_stmt_execute($query2);

    $query3 = mysqli_prepare($link, "update $table set size=? where product_id=?");
    mysqli_stmt_bind_param($query3, "ss", $si, $productid);
    mysqli_stmt_execute($query3);

    $query4 = mysqli_prepare($link, "update $table set description=? where product_id=?");
    mysqli_stmt_bind_param($query4, "ss", $description, $productid);
    mysqli_stmt_execute($query4);

    $query5 = mysqli_prepare($link, "update $table set price=? where product_id=?");
    mysqli_stmt_bind_param($query5, "is", $price, $productid);
    mysqli_stmt_execute($query5);

    $redirect = $redirects[$table];
    echo "<script> window.location='$redirect'; </script>";
} else {
    echo "<script> alert('No Table Exists'); window.location='edit.php'; </script>";
}
?>


