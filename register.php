  <?php 
		
		require_once('connect.php');

		$name= $_REQUEST['uname'];
		$emad= $_REQUEST['ead'];
		$pass= $_REQUEST['pass'];
		$repass= $_REQUEST['repass'];
                $dup = mysqli_prepare($link, "select * from register where username = ?");
                mysqli_stmt_bind_param($dup, "s", $name);
                mysqli_stmt_execute($dup);
                $dup1 = mysqli_stmt_get_result($dup);

		if( mysqli_num_rows($dup1) >=1)  { 
		    echo "<script> alert('User name is already exists.');
                window.location='signup.php';
             </script>";  

		}  
	    else { 
            if($pass==$repass){
                        $encp = password_hash($pass, PASSWORD_DEFAULT);
                        $query = mysqli_prepare($link, "insert into register(username,password,email) values (?,?,?)");
                        mysqli_stmt_bind_param($query, "sss", $name, $encp, $emad);
                        mysqli_stmt_execute($query);
                echo "<script>
                    window.location='login.php';
                </script>";
            }
            else{
                echo "<script>
                        alert('Password not match');
                        window.location='signup.php';
                    </script>";
                }
            }
		?>
