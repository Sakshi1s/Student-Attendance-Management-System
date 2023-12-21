<?php
include "config/conn.php";
include "config/session.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Update Teacher Data</title>
</head>

<body>

    <div class="container">
        <header class="font-weight-bolder text-center header">
            <h1> Teacher Registration </h1>
        </header>
        <?php
        $tid = $_GET['tid'];
        $sql = "SELECT * FROM tblteacher WHERE tid={$tid}" or die("Checking failed");
        $res = mysqli_query($conn, $sql) or die("Result Failed");
        if (mysqli_num_rows($res) > 0) {
            while ($serow = mysqli_fetch_assoc($res)) {

        ?>


                <form>
                    <input type="button" class="btn btn-warning m-3" value="Go back!" onclick="goBack()">
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF'] . "?tid=$tid"; ?>" method="POST">

                    <div class="fields row mb-2">
                        <div class="input-field col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="t_name" class="form-control" value="<?php echo $serow['tname']; ?>" placeholder="Enter your name">
                        </div>
                        <div class="input-field col-md-6">
                            <label class="form-label">Select Branch</label>
                            <!-- select branch -->
                            <?php
                            $sql1 = "SELECT * FROM tblbranch
                             ORDER BY bname";
                            $result1 = mysqli_query($conn, $sql1) or die("Query Failed: Branch option");
                            if (mysqli_num_rows($result1) > 0) {
                            ?>
                                <select required name="select_branch" class="form-control ">
                                    <option selected value="none">--Select Branch--</option>
                                    <?php while ($row = mysqli_fetch_assoc($result1)) {
                                        if ($serow['branch'] == $row['ID']) {
                                            $select = "selected";
                                        } else {
                                            $select = "";
                                        }
                                        echo "<option {$select} value={$row['ID']}>{$row['bname']}</option>";
                                    }
                                    ?>
                                </select>
                        <?php }
                                 ?>
                        </div>
                    </div>
                    <div class="fields row mb-2">
                        <div class="input-field col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" name="t_email" class="form-control" value="<?php echo $serow['temail']; ?>" placeholder="Enter your email">
                        </div>
                        <div class="input-field col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="t_password" value="<?php echo $serow['tpassword']; ?>" placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="fields row mt-3">
                        <div class="input-field col-md-6">
                            <label class="form-label">Select SEM</label>
                            <?php
                            $sql = "SELECT * FROM tblclass";
                            $result = mysqli_query($conn, $sql) or die("Query Failed: Sem option");
                            if (mysqli_num_rows($result) > 0) {

                            ?>
                                <select name="select_sem" class="form-control mb-3 ">
                                    <option value="none">--Select SEM--</option>
                                    <?php while ($row = mysqli_fetch_assoc($result)) {

                                        if ($serow['sem'] == $row['ID']) {
                                            $select1 = "selected";
                                        } else {
                                            $select1 = "";
                                        }
                                        echo "<option {$select1} value={$row['ID']}>{$row['nsem']}</option>";
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="input-field col-md-6">
                            <label class="form-label">Select Subject</label>
                            <!-- select subject -->
                            <?php
                            $sql_sub = "SELECT * FROM tblsubject
                                ORDER BY name";
                            $res_sub = mysqli_query($conn, $sql_sub) or die("Query Failed: Subject option");
                            if (mysqli_num_rows($res_sub) > 0) {
                            ?>
                                <select name="select_subject" class="form-control mb-3">

                                    <option value="none">--Select Subject--</option>
                                    <?php 
                                    
                                     while ($row_sub = mysqli_fetch_assoc($res_sub)) {
                                        if ($serow['subject'] == $row_sub['SID']) {
                                            $select1 = "selected";
                                        } else {
                                            $select1 = "";
                                        }
                                        echo "<option {$select1} value={$row_sub['SID']}>{$row_sub['name']}</option>";
                                    }
                                    ?>
                                </select>
                            <?php }
                            ?>
                        </div>

                    </div>
                    <button name="update" onclick="goBack()" class="btn btn-primary ">
                        <span class="btnText">Update</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </form>
        <?php }
        
                                }
        ?>
    </div>
</body>
<?php
if (isset($_POST['update'])) {

   
    $name = $_POST['t_name'];
     $email = $_POST['t_email'];
     $password = $_POST['t_password'];
     $branch = $_POST['select_branch'];
     $sem = $_POST['select_sem'];
     $subject = $_POST['select_subject'];


    $sql_i = 
    "UPDATE tblteacher SET tname='{$name}' , branch='{$branch}' , sem='{$sem}', temail='{$email}', tpassword = '{$password}', subject='{$subject}'
     WHERE tid={$tid}" or die("Update Failed");
    $update_res = mysqli_query($conn, $sql_i) or die("Update failed");
    if ($update_res) {
        // header("Location: http://localhost/Mini-Project/teacher.php");
        mysqli_close($conn);
        
    }
    else{
        echo "<script>alert('not updated')</script>";
    }
   
}
?>

<script>
    function goBack() {
        window.location.href = "teacher.php"
    }
</script>

</html>