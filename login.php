<?php 
include "config/conn.php";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));


    $role = $_POST['role'];

    //Login

    // Admin Condition
    if ($role == "admin") {
        $rolee = 1;
        $sql = "SELECT * FROM tbladmin WHERE email ='{$email}' AND password ='{$password}'";
    }
// Teacher Condition
    else{
            $rolee = 0;
            $sql = "SELECT * FROM tblteacher WHERE temail ='{$email}' AND tpassword ='{$password}'";
        }
        $result = mysqli_query($conn, $sql) or die("login failed");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                session_start();
                // admin
                if($rolee == 1){
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['ID'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['role'] = $rolee;
                }
                // Teacher
                else{
                    $_SESSION['name'] = $row['tname'];
                    $_SESSION['id'] = $row['tid'];
                    $_SESSION['email'] = $row['temail'];
                    $_SESSION['password'] = $row['tpassword'];
                    $_SESSION['sem'] = $row['sem'];
                    $_SESSION['branch'] = $row['branch'];
                    $_SESSION['subject'] = $row['subject'];
                    $_SESSION['role'] = $rolee;
                }
                
                mysqli_close($conn);
                header("Location: http://localhost/Mini-Project--main/Mini-Project--main/");
            }
        } else {
            echo "<script> alert('Email And Password is Incorrect');</script>";
        }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>
<div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="input-field">
                        <input type="text" name="email" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>

                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field">
                        <select name="role" id="">
                            <option disabled selected>Select role...</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                        </select>

                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Login">
                    </div>

                </form>

                <div class="input-field button">
                    <a href="index.php">Visit As Student/Parent</a>
                </div>
            </div>


        </div>

        <script>
            const pwShowHide = document.querySelectorAll(".showHidePw"),
                pwFields = document.querySelectorAll(".password");


            //   js code to show/hide password and change icon
            pwShowHide.forEach(eyeIcon => {
                eyeIcon.addEventListener("click", () => {
                    pwFields.forEach(pwField => {
                        if (pwField.type === "password") {
                            pwField.type = "text";

                            pwShowHide.forEach(icon => {
                                icon.classList.replace("uil-eye-slash", "uil-eye");
                            })
                        } else {
                            pwField.type = "password";

                            pwShowHide.forEach(icon => {
                                icon.classList.replace("uil-eye", "uil-eye-slash");
                            })
                        }
                    })
                })
            })
        </script>
</body>
</html>