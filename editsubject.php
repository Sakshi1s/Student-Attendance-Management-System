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
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Edit Subject</title>
</head>

<body>

    <div class="container align-items-center justify-content-center">
        <h1>Update Subject</h1>
        <?php
        $subid = $_GET['sid'];
        $sql = "SELECT * FROM tblsubject WHERE SID={$subid}" or die("Checking failed");
        $res = mysqli_query($conn, $sql) or die("Result Failed");
        if (mysqli_num_rows($res) > 0) {
            while ($serow = mysqli_fetch_assoc($res)) {

        ?>
                <form class="row" action="<?php echo $_SERVER['PHP_SELF'] . "?sid=$subid"; ?>" method="POST">
                    <div class="fields row">
                        <div class="input-field col">
                            <input type="hidden" value="<?php echo $serow['SID']; ?>" name="suid" class="form-control" placeholder="Enter Subject Name">
                            <input required type="text" value="<?php echo $serow['name']; ?>" name="sub_name" class="form-control" placeholder="Enter Subject Name">
                        </div>


                        <!-- select branch -->
                        <div class="input-field col ">
                            <?php
                            $sql1 = "SELECT * FROM tblbranch";
                            $result1 = mysqli_query($conn, $sql1) or die("Query Failed: Branch option");
                            if (mysqli_num_rows($result1) > 0) {
                            ?>
                                <select required name="branch" class="form-control ">
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


                    </div>
                    <button name="update" class="btn btn-primary ml-2">
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
    $subid = $_GET['sid'];
    $name = $_POST['sub_name'];
    $branch = $_POST['branch'];
    $sem = $_POST['sem'];
    $id = $_POST['suid'];


    $sql_i = "UPDATE tblsubject SET name='{$name}' , branch='{$branch}' , sem='{$sem}' WHERE SID={$id}" or die("Update Failed");
    $update_res = mysqli_query($conn, $sql_i) or die("UPdate failed");
    if ($update_res) {
        header("Location: http://localhost/Mini-Project/manage_subject.php");
        mysqli_close($conn);
    }
}
?>

</html>