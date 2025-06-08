  <?php 
		
		require_once('connect.php');

                $name   = $_POST['uname'] ?? '';
                $emad   = $_POST['ead'] ?? '';
                $pass   = $_POST['pass'] ?? '';
                $repass = $_POST['repass'] ?? '';

                $stmt = mysqli_prepare($link, "SELECT 1 FROM register WHERE username = ?");
                mysqli_stmt_bind_param($stmt, 's', $name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) >= 1) {
                    echo "<script> alert('User name is already exists.');
                window.location='signup.php';
             </script>";

                }
            else {
                if($pass === $repass){
                        $hashed = password_hash($pass, PASSWORD_DEFAULT);
                        $insert = mysqli_prepare($link, "INSERT INTO register (username, password, email) VALUES (?, ?, ?)");
                        mysqli_stmt_bind_param($insert, 'sss', $name, $hashed, $emad);
                        mysqli_stmt_execute($insert);
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
