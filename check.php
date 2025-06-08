         
<?php 
session_start();
require_once('connect.php');
        
$name2= $_REQUEST['uname1'];
$pass2= $_REQUEST['pass1'];


$name1 = stripslashes($name2);
$pass1= stripslashes($pass2);

$name = mysqli_real_escape_string($link,$name1);
$pass = mysqli_real_escape_string($link,$pass1);

$stmt = mysqli_prepare($link, "SELECT password FROM register WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if($row && password_verify($pass, $row['password'])){
    if(isset($_REQUEST['rem'])){
        setcookie("username", $name , time()+60*60*24 , '/' , 'localhost');
    }
    $_SESSION['login'] = true;
    $_SESSION['uname']=$name;

    echo "
            <script>
            window.location='index.php';
            alert('Login Successful');
            </script>";
}
            
else{
    echo "<script>
             alert('Login Unsuccessful');
            window.location='login.php';
            </script>";
}
?> 
