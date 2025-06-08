         
<?php 
session_start();
require_once('connect.php');
        
$name = $_POST['uname1'] ?? '';
$pass = $_POST['pass1'] ?? '';

$stmt = mysqli_prepare($link, "SELECT password FROM register WHERE username = ?");
mysqli_stmt_bind_param($stmt, 's', $name);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);

if($row && password_verify($pass, $row['password'])){
    if(isset($_REQUEST['rem'])){
        setcookie("username", $name , time()+60*60*24 , '/' , 'localhost');
    }
    $_SESSION['login'] = true;
    $_SESSION['uname']=$name;

    $tableName = preg_replace('/[^A-Za-z0-9_]/', '', $_SESSION['uname']);
    $query3 = "CREATE TABLE IF NOT EXISTS `" . $tableName . "`( product_id VARCHAR(100) NOT NULL , name VARCHAR(100) NOT NULL , price INT(100) NOT NULL , quantity INT(100) NOT NULL , PRIMARY KEY (product_id)) ENGINE = InnoDB";
    mysqli_query($link,$query3);

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
