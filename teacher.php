<?php

include 'config/conn.php';
include 'config/session.php';
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $branch = mysqli_real_escape_string($conn, $_POST['select_branch']);
    $sem = mysqli_real_escape_string($conn, $_POST['select_sem']);
    $subject = mysqli_real_escape_string($conn, $_POST['select_subject']);


    $check = "SELECT * FROM tblteacher WHERE temail='{$email}' ";

    $res = mysqli_query($conn, $check) or die("Checking Failed");


    if (mysqli_num_rows($res) > 0) {
        echo "<script>alert('Teacher Already Exist')</script>";
        header("Location: http://localhost/Mini-Project/teacher.php");
        die();
    } else {
        $sql = "INSERT INTO tblteacher(tname,temail,tpassword,branch,sem,subject) 
    VALUES('{$name}','{$email}','{$password}',{$branch},{$sem},{$subject})";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            header("Location: http://localhost/Mini-Project/teacher.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <!-- <link rel="stylesheet" href="student.css"> -->

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!--<title>Regisration Form </title>-->
</head>

<body>



    <div class="container ">
        <header class="font-weight-bolder text-center header">
            <h1> Teacher Registration </h1>
        </header>

        <form>
            <input type="button" class="btn btn-warning m-3" value="Go back!" onclick="goBack()">
        </form>
        <form action=<?php echo $_SERVER['PHP_SELF']?> method="POST">

            <div class="fields row mb-2">
                <div class="input-field col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
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
                        <select name="select_branch" class="form-control mb-3">
                            <option value="none">--Select Branch--</option>
                            <?php while ($row = mysqli_fetch_assoc($result1)) {
                                echo "<option value={$row['ID']}>{$row['bname']}</option>";
                            }
                            ?>
                        </select>
                    <?php } ?>
                </div>
            </div>
            <div class="fields row mb-2">
                <div class="input-field col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="input-field col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password">
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
                                echo "<option value={$row['ID']}>{$row['nsem']}</option>";
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
                                <?php while ($row_sub = mysqli_fetch_assoc($res_sub)) {
                                    echo "<option value={$row_sub['SID']}>{$row_sub['name']}</option>";
                                }
                                ?>
                            </select>
                        <?php }
                        ?>
                </div>
                
            </div>
            <button name="submit" class="btn btn-primary ">
                <span class="btnText">Submit</span>
                <i class="uil uil-navigator"></i>
            </button>
        </form>


        <!-- Teacher List  -->
    <div class="row mt-5 d-flex  justify-content-center ">
    <header class="font-weight-bolder  ">
            <h1> Teacher List </h1>
        </header>
    
            <table class="table align-items-center text-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>SEM</th>
                        <th>Branch</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <?php 
                    $fetch_sql = 
                    "SELECT * FROM tblteacher 
                    INNER JOIN tblclass 
                    ON tblteacher.sem = tblclass.ID
                    INNER JOIN tblbranch
                    ON tblteacher.branch = tblbranch.ID
                    INNER JOIN tblsubject
                    ON tblteacher.subject = tblsubject.SID
                    ORDER BY tblteacher.tname" or die("Fetching failed");
                    $res_fetch = mysqli_query($conn,$fetch_sql) or die("result failed");
                    if(mysqli_num_rows($res_fetch)>0){
                    ?>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($res_fetch)){ ?>
                    <tr>
                        <td><?php echo $row['tname']; ?></td>
                        <td><?php echo $row['nsem']; ?></td>
                        <td><?php echo $row['bname']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>
                            <a class="btn btn-success mb-2" href="editteacher.php?tid=<?php echo $row['tid']; ?>">Edit</a>
                            <a class="btn btn-danger mb-2" href="deleteteacher.php?tid=<?php echo $row['tid']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
                <?php }?>
            </table>
        </div>
    </div>
    

    
<script>
    function goBack() {
        window.location.href = "index.php"
      }
</script>

</html>