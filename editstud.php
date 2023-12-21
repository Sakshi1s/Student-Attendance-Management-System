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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<div class="container  align-center">
        <header  class="font-weight-bolder text-center " > <h1> Student Registration </h1></header>
        <?php
        $stid = $_GET['stid'];
        $sql = "SELECT * FROM tblstudent WHERE STID={$stid}" or die("Checking failed");
        $res = mysqli_query($conn, $sql) or die("Result Failed");
        if (mysqli_num_rows($res) > 0) {
            while ($serow = mysqli_fetch_assoc($res)) {
            
        ?>

        <form class="row mt-3 g-3" action="<?php echo $_SERVER['PHP_SELF']."?stid={$stid}"; ?>" method="POST">
     
              
                <!-- <input type="hidden" name="name" value="<?php echo $serow['STID']; ?>" class="form-control" placeholder="Enter your name" required> -->
            
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="sname" value="<?php echo $serow['sname']; ?>" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" name="email" value="<?php echo $serow['email']; ?>" class="form-control" placeholder="Enter your email" required>

            </div>

            <div class="col-md-4">
                <label class="form-label">PRN</label>
                <input type="number" name="prn" value="<?php echo $serow['prn']; ?>" class="form-control" placeholder="Enter your prn" required>
            </div>
            <!-- Select semester -->
            <div class="col-md-4">
                <label class="form-label">Semester</label>
                <?php
                        $sql = "SELECT * FROM tblclass";
                        $result = mysqli_query($conn, $sql) or die("Query Failed: Sem option");
                        if (mysqli_num_rows($result) > 0) {

                        ?>
                            <select name="sem" class="form-control mb-3 ">
                                <option value="none">--Select SEM--</option>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    if($row['ID'] == $serow['sem']){
                                        $select ="selected";
                                    }
                                    else{
                                        $select="";
                                    }
                                    echo "<option {$select} value={$row['ID']}>{$row['nsem']}</option>";
                                }
                                ?>
                            </select>
                        <?php } ?>
            </div>
            <!-- Select  branch -->
            <div class="col-md-4">
                <label class="form-label">Branch</label>
                <?php
                    $sql1 = "SELECT * FROM tblbranch";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed: Branch option");
                    if (mysqli_num_rows($result1) > 0) {
                    ?>
                        <select name="branch" class="form-control ">
                            <option value="none">--Select Branch--</option>
                            <?php while ($row = mysqli_fetch_assoc($result1)) {
                                 if($row['ID'] == $serow['branch']){
                                    $select ="selected";
                                }
                                else{
                                    $select="";
                                }

                                echo "<option {$select} value={$row['ID']}>{$row['bname']}</option>";
                            }
                            ?>
                        </select>
                    <?php } ?>
            </div>

            <button name="update" class="btn btn-primary my-3">
                Submit
                <i class="uil uil-navigator"></i>
            </button>
        </form>

        <?php     }}
        ?>
</div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $stid = $_GET['stid'];
    $name = $_POST['sname'];
    $branch = $_POST['branch'];
    $sem = $_POST['sem'];
    $email = $_POST['email'];
    $prn = $_POST['prn'];
    // $id = $_POST['STID'];


    $sql_i = "UPDATE tblstudent SET sname='{$name}' , branch='{$branch}' , email='{$email}' , prn ='{$prn}' , sem='{$sem}' WHERE STID={$stid}" or die("Update Failed");
    $update_res = mysqli_query($conn, $sql_i) or die("UPdate failed");
    if ($update_res) {
        echo "<script>alert('update Successfull')</script>";
        header("Location: http://localhost/Mini-Project/student.php");
        mysqli_close($conn);
    }
}
?>

