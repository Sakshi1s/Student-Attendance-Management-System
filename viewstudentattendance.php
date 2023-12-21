<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <title>Dashboard</title>
</head>
<style>
  header {
            background-color: #0A2558;
            height: 50px;
            text-align: center;
            font-size: 30px;
            font-family: 'Poppins', sans-serif;
            color: rgb(255, 255, 255);
        }
</style>
<body>
<header>
        <h2>Student Attendance</h2>
</header>

    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
    <form>
        <a  class="btn btn-warning m-3" href="index.php">Go back!</a>
      </form>
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">View Student Attendance</h6>

                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group row mb-3">
                                <div class="col-xl-6">
                                    <label class="form-control-label">Select Student<span class="text-danger ml-2">*</span></label>

                                    <?php include 'config/conn.php';

                                    $sql = "SELECT prn,sname FROM tblstudent";
                                    $result = mysqli_query($conn, $sql) or die("Query Failed: student name option");
                                    if (mysqli_num_rows($result) > 0) {

                                    ?>
                                        <select required name="studentlist" class="form-control mb-3">
                                            <option value="none">--Select Student--</option>
                                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option  value='{$row['sname']}'>{$row['sname']}</option>";
                                            }

                                            ?>

                                        </select>

                                    <?php }

                                    ?>
                                </div>
                                
                            </div>

                            <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                            <form>

 </form>
                        </form>

                        <!-- filter varible intilzation -->



                    </div>
                </div>

                <!-- Input Group -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>PRN No</th>
                                            <th>SEM</th>
                                            <th>Subject</th>
                                            <!-- <th>Status</th> -->
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    // filter active
                                    if (isset($_POST['view'])) {
                                        $sprn = $_POST['studentlist'];
                                        if ($sprn == "none") {
                                            $sql2 = "SELECT * FROM tblattendance";
                                        } else {
                                            $sql2 = "SELECT * FROM tblattendance WHERE name='{$sprn}'";
                                        }
                                        $result2 = mysqli_query($conn, $sql2) or die("Query Failed: student attendance display failed");
                                        if (mysqli_num_rows($result) > 0) {
                                    ?>
                                            <tbody>
                                                <?php while ($row1 = mysqli_fetch_assoc($result2)) { ?>
                                                    <tr>
                                             <td><?php echo $row1['name']?></td>
                                             <td><?php echo $row1['prn'] ?></td>
                                             <td><?php echo $row1['sem'] ?></td>
                                             <td><?php echo $row1['subject'] ?></td>
                                            
                                             <td><?php echo $row1['date'] ?></td>
                                         </tr>
                                              
                                        <?php } ?>

                                            </tbody>
                                        <?php }
                                    }


                                    //  filter not active

                                    else {
                                        $sql2 = "SELECT * FROM tblattendance";
                                        $result2 = mysqli_query($conn, $sql2) or die("Query Failed: student attendance display failed");
                                        if (mysqli_num_rows($result) > 0) {
                                        ?>
                                            <tbody>
                                                <?php while ($row1 = mysqli_fetch_assoc($result2)) {

                                                    echo "<tr>
                                            <td>{$row1['name']}</td>
                                            <td>{$row1['prn']}</td>
                                            <td>{$row1['sem']}</td>
                                            <td>{$row1['subject']}</td>
                                           
                                            <td> {$row1['date']}</td>
                                        </tr>";
                                                } ?>


                                            </tbody>
                                    <?php }
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->


        </div>
        <!---Container Fluid-->



</body>

</html>