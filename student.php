<?php
include "config/session.php"; 

include 'config/conn.php';
if (isset($_POST['submit'])) {
     $name = mysqli_real_escape_string($conn, $_POST['name']);
     $prn = mysqli_real_escape_string($conn, $_POST['prn']);
     $sem = mysqli_real_escape_string($conn, $_POST['select_sem']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $branch = mysqli_real_escape_string($conn, $_POST['select_branch']);

    $check = "SELECT sname FROM tblstudent WHERE email='{$email}' ";
    $res = mysqli_query($conn, $check) or die("Checking Failed");

    if (mysqli_num_rows($res) > 0) {
        echo "<script>alert($name already Exist)</script>";
        die();
        header("Location: http://localhost/ams/");

    } else {
        $sql = "INSERT INTO tblstudent(prn,sname,email,sem,branch) 
    VALUES({$prn},'{$name}','{$email}',{$sem},'{$branch}')";
        if (mysqli_query($conn, $sql)) {
            header("Location: http://localhost/ams/");
        }
    }
}
?>
<!-- file upload student  -->
<?php 
if(isset($_POST['filebtn'])){
    $fileName = $_FILES['file']['name'];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));

    // $newfileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;
    // $targetDir = $newfileName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $fileExtension);
    error_reporting(0);
    ini_set('display_errors',0);

    require "excelReader/excel_reader2.php";
    require "excelReader/SpreadsheetReader.php";
    
    // $reader = new SpreadsheetReader($fileExtension);
    foreach( $reader as $key => $row ){
        $name = $row[0];
        $prn = $row[1];
        $email = $row[2];
        $sem = $row[3];
        $branch = $row[4];
        $sql = "INSERT INTO tblstudent(sname,prn,email,sem,branch) VALUES('$name','$prn','$email','$sem','$branch') " or die("Import failed");
        mysqli_query($conn, $sql);
    }
    echo "<script> alert('Imported successfully');</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="student.css">
    <link rel="stylesheet" href="style.css">

    <!----===== Iconscout CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--<title>Regisration Form </title>-->
</head>

<body>


    <div class="container  align-center">
        <header  class="font-weight-bolder text-center " > <h1> Student Registration </h1></header>

        <form class="row mt-3 g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Enter your email" required>

            </div>

            <div class="col-md-4">
                <label class="form-label">PRN</label>
                <input type="number" name="prn" class="form-control" placeholder="Enter your prn" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Semester</label>
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

            <div class="col-md-4">
                <label class="form-label">Branch</label>
                <?php
                    $sql1 = "SELECT * FROM tblbranch";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Failed: Branch option");
                    if (mysqli_num_rows($result1) > 0) {
                    ?>
                        <select name="select_branch" class="form-control ">
                            <option value="none">--Select Branch--</option>
                            <?php while ($row = mysqli_fetch_assoc($result1)) {
                                echo "<option value={$row['ID']}>{$row['bname']}</option>";
                            }
                            ?>
                        </select>
                    <?php } ?>
            </div>

            <button name="submit" class="btn btn-primary my-3">
                Submit
                <i class="uil uil-navigator"></i>
            </button>
        </form>

        <form class="row" action="" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">

            <label class="form-label">Upload Excel File</label>
                <input type="file" name="file" required class="form-control"> <br>

                <button class="btn btn-primary my-3" name="filebtn">Import</button>
            </div>
        </form>
    </div>

    <!-- Student List -->

    <div class="row d-flex m-2 justify-content-center">
        <div class="row text-center">
        <h1>Student List</h1>
        </div>
    
            <table class="table align-items-center text-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>SEM</th>
                        <th>Branch</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <?php 
                    $fetch_sql = 
                    "SELECT * FROM tblstudent 
                    INNER JOIN tblclass 
                    ON tblstudent.sem = tblclass.ID
                    INNER JOIN tblbranch
                    ON tblstudent.branch = tblbranch.ID
                    ORDER BY sname" or die("Fetching failed");
                    $res_fetch = mysqli_query($conn,$fetch_sql) or die("result failed");
                    if(mysqli_num_rows($res_fetch)>0){
                    ?>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($res_fetch)){ ?>
                    <tr>
                        <td><?php echo $row['sname']; ?></td>
                        <td><?php echo $row['nsem']; ?></td>
                        <td><?php echo $row['bname']; ?></td>
                        <td>
                            <a class="btn btn-success mb-2" href="editstud.php?stid=<?php echo $row['STID']; ?>">Edit</a>
                            <a class="btn btn-danger mb-2" href="deletestud.php?stid=<?php echo $row['STID']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
                <?php }?>
            </table>
        </div>



</body>

</html>