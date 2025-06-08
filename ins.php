<?php
	require_once('connect.php');
        $table=$_REQUEST['tablename'];
        $name=$_REQUEST['name'];
        $productid=$_REQUEST['productid'];
        $image=$_REQUEST['image'];
        $price=$_REQUEST['price'];
        $si=$_REQUEST['size'];
        $description=$_REQUEST['description'];

        if(in_array($table,['mobile','laptop','watch','television'])){
        $stmt = mysqli_prepare($link, "select * from $table where product_id=?");
        mysqli_stmt_bind_param($stmt, "s", $productid);
        mysqli_stmt_execute($stmt);
        $dup=mysqli_stmt_get_result($stmt);
                if( mysqli_num_rows($dup)>=1)  {
                    echo "<script> alert('Product ID already exists.');
                window.location='insert.php';
             </script>";
                }
            else {
            if($table=='mobile'){
                        $query = mysqli_prepare($link, "insert into mobile values (?,?,?,?,?,?)");
                        mysqli_stmt_bind_param($query, "sssiss", $name, $si, $productid, $price, $image, $description);
                        mysqli_stmt_execute($query);
                echo "<script>
                        window.location='mobile.php';
                </script>";
            }
            else if($table=='laptop'){
                        $query = mysqli_prepare($link, "insert into laptop values (?,?,?,?,?,?)");
                        mysqli_stmt_bind_param($query, "sssiss", $name, $si, $productid, $price, $image, $description);
                        mysqli_stmt_execute($query);
                echo "<script>
                        window.location='laptop.php';
                </script>";
            }
            else if($table=='watch'){
                        $query = mysqli_prepare($link, "insert into watch values (?,?,?,?,?,?)");
                        mysqli_stmt_bind_param($query, "sssiss", $name, $si, $productid, $price, $image, $description);
                        mysqli_stmt_execute($query);
                echo "<script>
                        window.location='watch.php';
                </script>";
            }
            else if($table=='television'){
                        $query = mysqli_prepare($link, "insert into television values (?,?,?,?,?,?)");
                        mysqli_stmt_bind_param($query, "sssiss", $name, $si, $productid, $price, $image, $description);
                        mysqli_stmt_execute($query);
                echo "<script>
                        window.location='tv.php';
                </script>";
            }
            else{
                echo "<script>
                        alert('No Table Exists');
                                window.location='insert.php';
                    </script>";
                }
            }
        } else {
            echo "<script>
                    alert('No Table Exists');
                            window.location='insert.php';
                </script>";
        }
?>


