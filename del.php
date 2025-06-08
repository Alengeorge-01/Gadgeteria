<?php
	require_once('connect.php');
        $table=$_REQUEST['tablename'];
        $productid=$_REQUEST['productid'];

        if(in_array($table, ['mobile','laptop','watch','television'])){
        $stmt = mysqli_prepare($link, "select * from $table where product_id = ?");
        mysqli_stmt_bind_param($stmt, "s", $productid);
        mysqli_stmt_execute($stmt);
        $dup1 = mysqli_stmt_get_result($stmt);
                if( mysqli_num_rows($dup1)==0)  {
                    echo "<script>
                alert('Product ID doesnt exists');
                window.location='delete.php';
                </script>";
                }
            else {
            $del = mysqli_prepare($link, " delete from $table where product_id=?");
            mysqli_stmt_bind_param($del, "s", $productid);
            mysqli_stmt_execute($del);
            if($table=='mobile'){
                echo "<script>
                        window.location='mobile.php';
                </script>";
            }
            else if($table=='laptop'){
                echo "<script>
                        window.location='laptop.php';
                </script>";
            }
            else if($table=='watch'){
                echo "<script>
                        window.location='watch.php';
                </script>";
            }
            else if($table=='television'){
                echo "<script>
                        window.location='tv.php';
                </script>";
            }
            else{
                echo "<script>
                        alert('No Table Exists');
                                window.location='delete.php';
                    </script>";
                }
            }
        } else {
            echo "<script>
                    alert('No Table Exists');
                            window.location='delete.php';
                </script>";
        }
?>


