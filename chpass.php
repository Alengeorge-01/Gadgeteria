<?php 
	require_once('connect.php');
    $name = $_REQUEST["uname2"]; 
	$newpwd = $_REQUEST["pass2"]; 
	$mail= $_REQUEST["email2"];
         $query = mysqli_prepare($link, "select * from register where username = ? and email = ?");
        mysqli_stmt_bind_param($query, "ss", $name, $mail);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);
         if(mysqli_num_rows($result) == 1){
                $enpwd = password_hash( $newpwd , PASSWORD_DEFAULT);
                $update = mysqli_prepare($link, " update register set password = ? WHERE username = ?");
               mysqli_stmt_bind_param($update, "ss", $enpwd, $name);
               mysqli_stmt_execute( $update );
        echo "
            <script>
                window.location='index.php';
                alert('Password has been updated successfully');
            </script>" ;
	}  
?>
