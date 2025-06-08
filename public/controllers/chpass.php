<?php 
	require_once('connect.php');
    $name   = $_POST["uname2"] ?? '';
    $newpwd = $_POST["pass2"] ?? '';
    $mail   = $_POST["email2"] ?? '';
    $hash   = password_hash($newpwd, PASSWORD_DEFAULT);
    $query = mysqli_prepare($link, "SELECT 1 FROM register WHERE username = ? AND email = ?");
    mysqli_stmt_bind_param($query, 'ss', $name, $mail);
    mysqli_stmt_execute($query);
    mysqli_stmt_store_result($query);
    if(mysqli_stmt_num_rows($query) == 1){
            $update = mysqli_prepare($link, "UPDATE register SET password = ? WHERE username = ?");
            mysqli_stmt_bind_param($update, 'ss', $hash, $name);
            mysqli_stmt_execute($update);
            echo "
                <script>
                    window.location='index.php';
                    alert('Password has been updated successfully');
                </script>" ;
        }
?>
