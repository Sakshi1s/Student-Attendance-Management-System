<?php 
include "config/conn.php";
include "config/session.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>
 
    <div class="container  justify-content-center">
        <header class="text-center">
        <h1>Add Subject</h1>
        </header>
        
        <form class="row m-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="row ">

                <div class="fields row">
                    <div class="input-field col">
                        <input required type="text" name="sub_name" class="form-control" placeholder="Enter Subject Name">
                    </div>

                    <!-- select branch -->
                    <div class="input-field col ">
                        <?php
                        $sql1 = "SELECT * FROM tblbranch";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed: Branch option");
                        if (mysqli_num_rows($result1) > 0) {
                        ?>
                            <select required name="branch" class="form-control ">
                                <option selected disabled value="none">--Select Branch--</option>
                                <?php while ($row = mysqli_fetch_assoc($result1)) {
                                    echo "<option value={$row['ID']}>{$row['bname']}</option>";
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>

                    <!-- select sem -->
                    <div class="input-field col ">
                        <?php
                        $sql = "SELECT * FROM tblclass";
                        $result = mysqli_query($conn, $sql) or die("Query Failed: Sem option");
                        if (mysqli_num_rows($result) > 0) {

                        ?>
                            <select required name="sem" class="form-control ">
                                <option selected value="none">--Select SEM--</option>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value={$row['ID']}>{$row['nsem']}</option>";
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>


                </div>
                <button name="submit" class="btn btn-primary ml-4">
                    <span class="btnText">Submit</span>
                    <i class="uil uil-navigator"></i>
                </button>
        </form>
        <br>
    </div>

    <div class="row d-flex  justify-content-center">
        <div class="row ">
        <h1>Subject List</h1>
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
                <!-- fetching data of subject using inner join to know their sem and branch they belong -->
                    <?php 
                    $fetch_sql = 
                    "SELECT * FROM tblsubject 
                    INNER JOIN tblclass 
                    ON tblsubject.sem = tblclass.ID
                    INNER JOIN tblbranch
                    ON tblsubject.branch = tblbranch.ID
                    ORDER BY name" or die("Fetching failed");
                    $res_fetch = mysqli_query($conn,$fetch_sql) or die("result failed");
                    // if one or more row exist the while loop will run
                    if(mysqli_num_rows($res_fetch)>0){
                    ?>
                <tbody>
                    <!-- it will run upto the last row  -->
                    <?php while($row = mysqli_fetch_assoc($res_fetch)){ ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['nsem']; ?></td>
                        <td><?php echo $row['bname']; ?></td>
                        <td>
                            <!--  we use ?sid =$row['SID'] to know the next page that we demand to edit or delete this row -->
                            <a class="btn btn-success mb-2" href="editsubject.php?sid=<?php echo $row['SID']; ?>">Edit</a>
                            <a class="btn btn-danger mb-2" href="deletesubject.php?suid=<?php echo $row['SID']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
                <?php }?>
            </table>
        </div>
</body>


<script>
    function goBack() {
        window.location.href = "index.php"
      }
</script>

</html>

<?php
if (isset($_POST['submit'])) {

    $name = $_POST['sub_name'];
    $branch = $_POST['branch'];
    $sem = $_POST['sem'];

    if($name == "" && $branch =="none" && $sem == "none"){
        echo "Done";
        die();
        mysqli_close($conn);
        // header("Location: http://localhost/Mini-Project/manage_subject.php");

    }
    else{
    $check = "SELECT name FROM tblsubject WHERE name='{$name}'" or die("Checking failed");
    $check_res = mysqli_query($conn, $check);
    if (mysqli_fetch_assoc($check_res) > 0) {
        echo "<script>alert('$name Subject Already Exists')</script>";
        mysqli_close($conn);
        // header("Location: http://localhost/Mini-Project/manage_subject.php");
        die();
        
    } else {
        $sql_i = "INSERT INTO tblsubject(name,branch,sem) VALUES('{$name}','{$branch}','{$sem}')" or die("Query Failed");

        if(mysqli_query($conn, $sql_i)) {
            // header("Location: http://localhost/Mini-Project/manage_subject.php");
            echo "<script>alert('$name Subject added successfully')</script>";
            mysqli_close($conn);
        }
    }
}
}

?>